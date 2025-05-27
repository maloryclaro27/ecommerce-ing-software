<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;

class NegocioController extends Controller
{
    // Mostrar catálogo del negocio del dueño autenticado
    public function catalogo()
    {
        $user = Auth::user();
        $products = Producto::where('user_id', Auth::id())->get();

        $business = (object)[
            'id' => Auth::id(),
            'name' => Auth::user()->nombre_negocio,
        ];

        return view('catalogo_dueno', compact('products', 'business'));
    }

    // Guardar nuevo producto (AJAX)
    public function store(Request $request, $id)
    {
        
        $request->validate([
            'nombre' => 'required|string|max:90',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            //'imagen' => 'nullable|image|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create([
            'user_id'     => Auth::id(),
            'category_id' => Auth::user()->categoria_negocio,
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            //'imagen'      => $rutaImagen ? '/storage/' . $rutaImagen : '',
        ]);
        dd($producto->toArray());

        return response()->json(['success' => true]);
    }


    // Actualizar producto (AJAX)
    public function update(Request $request, $id, $productId)
    {
        $producto = Producto::where('id', $productId)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        $request->validate([
            'nombre' => 'required|string|max:90',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen antigua
            if ($producto->imagen && Storage::disk('public')->exists(str_replace('/storage/', '', $producto->imagen))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $producto->imagen));
            }
            $producto->imagen = '/storage/' . $request->file('imagen')->store('productos', 'public');
        }

        $producto->update([
            'category_id' => Auth::user()->categoria_negocio,
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
        ]);

        return response()->json(['success' => true]);
    }

    // Eliminar producto (AJAX)
    public function destroy($id, $productId)
    {
        $producto = Producto::where('id', $productId)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        if ($producto->imagen && Storage::disk('public')->exists(str_replace('/storage/', '', $producto->imagen))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $producto->imagen));
        }

        $producto->delete();

        return response()->json(['success' => true]);
    }

    // Mostrar formulario clásico para crear (no lo usas ahora)
    public function create()
    {
        return view('negocio.productos.create');
    }

    // Mostrar formulario clásico para editar (no lo usas ahora)
    public function edit($id)
    {
        $producto = Producto::where('id', $id)
                            ->where('user_id', Auth::id())
                            ->firstOrFail();

        return view('negocio.productos.edit', compact('producto'));
    }

    // Página de estadísticas del negocio
    public function estadisticas()
    {
        return view('negocio.estadisticas');
    }

    // Página de configuración del negocio
    public function configuracion()
    {
        $usuario = Auth::user();
        return view('negocio.configuracion', compact('usuario'));
    }

    // Domicilios del negocio
    public function domicilios()
    {
        return view('negocio.domicilios');
    }
}
