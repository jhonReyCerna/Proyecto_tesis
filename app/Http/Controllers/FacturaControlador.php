<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacturaControlador extends Controller
{
    public function show($id)
    {
        $venta = Venta::with('cliente', 'detalles.producto')->findOrFail($id);

        // Definir el nombre y la ruta del archivo QR
        $qrCodeFileName = 'qr_codes/factura_' . $venta->id_venta . '.png';
        $qrCodePath = storage_path('app/public/' . $qrCodeFileName);

        // Generar y guardar el código QR
        QrCode::format('png')->size(150)->generate('Factura de Venta #' . $venta->id_venta, $qrCodePath);

        // Generar la URL accesible del QR code
        $qrCodeUrl = asset('storage/' . $qrCodeFileName);

        // Cargar la vista con los datos necesarios
        $pdf = Pdf::loadView('factura', compact('venta', 'qrCodeUrl'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('factura_' . $venta->id_venta . '.pdf');
    }
}
