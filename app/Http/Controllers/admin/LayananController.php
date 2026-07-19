<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class LayananController extends Controller
{
    public function index()
    {
        $data     = Layanan::with('kategoriRelation')->latest('id')->get();
        $kategori = Kategori::all();

        return view('admin.layanan', compact('data', 'kategori'));
    }

    // ── EKSPOR EXCEL (XLSX) ──
    public function export(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer|exists:layanan,id',
        ]);

        $layanan = Layanan::with('kategoriRelation')
            ->whereIn('id', $request->ids)
            ->orderBy('id_kategori')
            ->orderBy('nama')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Layanan');

        // ── JUDUL LAPORAN ──
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Data Layanan Portal Polibatam');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F46E5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(36);

        // ── SUB JUDUL (tanggal ekspor) ──
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Diekspor pada: ' . now()->format('d F Y, H:i'));
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['italic' => true, 'size' => 10, 'color' => ['rgb' => '6B7280']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F1F5F9']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(20);

        // ── BARIS KOSONG ──
        $sheet->getRowDimension(3)->setRowHeight(8);

        // ── HEADER KOLOM ──
        $headers = ['No', 'Nama Layanan', 'Kategori', 'URL', 'Deskripsi', 'Status'];
        foreach ($headers as $i => $header) {
            $col = chr(65 + $i); // A, B, C, ...
            $sheet->setCellValue("{$col}4", $header);
        }

        $sheet->getStyle('A4:F4')->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '6366F1']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'C7D2FE']]],
        ]);
        $sheet->getRowDimension(4)->setRowHeight(28);

        // ── DATA BARIS ──
        $no    = 1;
        $row   = 5;
        $shade = false;

        foreach ($layanan as $item) {
            $status = match ((int) $item->is_active) {
                1       => 'Aktif',
                2       => 'Sedang Gangguan',
                default => 'Nonaktif',
            };

            $sheet->setCellValue("A{$row}", $no);
            $sheet->setCellValue("B{$row}", $item->nama);
            $sheet->setCellValue("C{$row}", $item->kategori ?? 'Tanpa Kategori');
            $sheet->setCellValue("D{$row}", $item->url);
            $sheet->setCellValue("E{$row}", $item->deskripsi ?? '-');
            $sheet->setCellValue("F{$row}", $status);

            // Warna baris selang-seling
            $bgColor = $shade ? 'F5F3FF' : 'FFFFFF';
            $shade   = !$shade;

            $sheet->getStyle("A{$row}:F{$row}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bgColor]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E5E7EB']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            // Warna kolom Status
            $statusColor = match ($status) {
                'Aktif'           => ['font' => '166534', 'bg' => 'DCFCE7'],
                'Sedang Gangguan' => ['font' => '92400E', 'bg' => 'FEF3C7'],
                default           => ['font' => '991B1B', 'bg' => 'FEE2E2'],
            };
            $sheet->getStyle("F{$row}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => $statusColor['font']]],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $statusColor['bg']]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);

            $sheet->getRowDimension($row)->setRowHeight(22);
            $no++;
            $row++;
        }

        // ── FOOTER ──
        $sheet->mergeCells("A{$row}:F{$row}");
        $sheet->setCellValue("A{$row}", 'Total: ' . count($layanan) . ' layanan');
        $sheet->getStyle("A{$row}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => '4F46E5']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EEF2FF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'C7D2FE']]],
        ]);

        // ── LEBAR KOLOM ──
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(28);
        $sheet->getColumnDimension('C')->setWidth(22);
        $sheet->getColumnDimension('D')->setWidth(45);
        $sheet->getColumnDimension('E')->setWidth(35);
        $sheet->getColumnDimension('F')->setWidth(18);

        // ── CENTER kolom No & Status ──
        $sheet->getStyle("A5:A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // ── URL jadi hyperlink ──
        $urlRow = 5;
        foreach ($layanan as $item) {
            if ($item->url) {
                $sheet->getCell("D{$urlRow}")->getHyperlink()->setUrl($item->url);
                $sheet->getStyle("D{$urlRow}")->applyFromArray([
                    'font' => ['color' => ['rgb' => '2563EB'], 'underline' => Font::UNDERLINE_SINGLE],
                ]);
            }
            $urlRow++;
        }

        // ── FREEZE HEADER ──
        $sheet->freezePane('A5');

        // ── OUTPUT ──
        $filename = 'layanan_' . now()->format('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // ── CEK STATUS URL ──
    public function checkUrlStatus($url)
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ])
            ->timeout(8)
            ->withoutVerifying()
            ->get($url);

            $status = $response->status();

            if ($status >= 200 && $status < 400) return 1;
            if ($status >= 500) return 2;
            return 0;

        } catch (ConnectionException $e) {
            $msg = strtolower($e->getMessage());
            if (str_contains($msg, 'timed out') || str_contains($msg, 'timeout') || str_contains($msg, 'operation timed')) {
                return 2;
            }
            return 0;
        } catch (\Exception $e) {
            $msg = strtolower($e->getMessage());
            if (str_contains($msg, 'timed out') || str_contains($msg, 'timeout')) {
                return 2;
            }
            return 0;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'nama'        => 'required|string|max:255',
            'url'         => 'required|url',
            'deskripsi'   => 'nullable|string|max:500',
        ]);

        Layanan::create([
            'id_kategori' => $request->id_kategori,
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'url'         => $request->url,
            'is_active'   => $this->checkUrlStatus($request->url),
        ]);

        return back()->with('success', 'Layanan ditambahkan & Status dicek otomatis!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'nama'        => 'required|string|max:255',
            'url'         => 'required|url',
            'deskripsi'   => 'nullable|string|max:500',
        ]);

        Layanan::findOrFail($id)->update([
            'id_kategori' => $request->id_kategori,
            'nama'        => $request->nama,
            'deskripsi'   => $request->deskripsi,
            'url'         => $request->url,
            'is_active'   => $this->checkUrlStatus($request->url),
        ]);

        return back()->with('success', 'Layanan diupdate & Status diperbarui otomatis!');
    }

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();

        return back()->with('success', 'Berhasil hapus layanan');
    }
}