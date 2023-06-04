<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Insumo;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('insumos')->paginate(10);

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();

        // Obtén las categorías disponibles (nombre y ID) desde el modelo de Categoría
        $categorias = Categorium::pluck('nombre', 'id');

        // Obtén los insumos disponibles (nombre y ID) desde el modelo de Insumo
        $insumos = Insumo::pluck('nombre', 'id');

        return view('producto.create', compact('producto', 'categorias', 'insumos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,png|max:2048',
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'activo' => '', //No validar para que pueda ser enviado correctamente
            'categorias_id' => 'required',
            'insumos' => 'required|array' // Validar que se envíen los insumos como un array
        ]);

        $producto = new Producto();

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categorias_id = $request->input('categorias_id');
        $producto->descripcion = $request->input('descripcion');
        $producto->activo = $request->has('activo'); // Guarda el estado como true o false según si se seleccionó o no el checkbox

        // Verificar si se ha enviado una imagen
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img/ProductosIMG'), $imageName);

            // Asignar la ruta de la imagen al modelo
            $producto->imagen = 'img/ProductosIMG/' . $imageName;
        }

        // Guardar el registro en la base de datos
        $producto->save();

        // Obtener los insumos seleccionados del formulario
        $insumos = $request->input('insumos');

        // Asociar los insumos al producto a través de la relación de muchos a muchos
        $producto->insumos()->attach($insumos);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categorium::pluck('nombre', 'id');
        // Obtén los insumos disponibles (nombre y ID) desde el modelo de Insumo
        $insumos = Insumo::pluck('nombre', 'id');
        return view('producto.edit', compact('producto', 'categorias', 'insumos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Buscar el producto existente en la base de datos
        $producto = Producto::find($id);

        // Verificar si el producto se encontró
        if (!$producto) {
            return view('error')->with('message', 'El producto no existe');
            // return redirect()->route('productos.index')->with('error', 'El producto no existe');
        }
        //  Validar los datos de entrada
        $request->validate(Producto::$rulesUpdate);

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la nueva imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img/ProductosIMG'), $imageName);

            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                $oldImagePath = public_path('img/ProductosIMG') . '/' . $producto->imagen;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Actualizar la ruta de la imagen en el modelo
            $producto->imagen = 'img/ProductosIMG/' . $imageName;
        }

        // Actualizar los atributos del producto
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->activo = $request->has('activo'); // Guarda el estado como true o false según si se seleccionó o no el checkbox
        $producto->categorias_id = $request->input('categorias_id');

        // Guardar los cambios en la base de datos
        $producto->save();

        // Sincronizar los insumos en la tabla pivot
        $insumos = $request->input('insumos');
        $producto->insumos()->sync($insumos);
        // Redireccionar a la página de índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto Eliminado correctamente');
    }
}
