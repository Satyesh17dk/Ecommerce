<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductImageModel;

class Product extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        $products = $productModel->findAll();

        foreach ($products as &$product) {
            $product['images'] = $imageModel
                ->where('product_id', $product['id'])
                ->findAll();
        }

        return view('admin/product/index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin/product/create');
    }

    public function store()
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        $productId = $productModel->insert([
            'name'   => $this->request->getPost('name'),
            'price'  => $this->request->getPost('price'),
            'status' => 1
        ]);

        // Multiple image upload
        $files = $this->request->getFiles();

        if (isset($files['images'])) {
            foreach ($files['images'] as $file) {

                if ($file->isValid() && !$file->hasMoved()) {

                    $newName = $file->getRandomName();
                    $file->move('uploads/products/', $newName);

                    $imageModel->insert([
                        'product_id' => $productId,
                        'image_path' => 'uploads/products/' . $newName
                    ]);
                }
            }
        }

        return redirect()->to('/admin/product');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        return view('admin/product/edit', [
            'product' => $productModel->find($id),
            'images'  => $imageModel->where('product_id', $id)->findAll()
        ]);
    }

    public function update($id)
    {
        $productModel = new ProductModel();

        $productModel->update($id, [
            'name'   => $this->request->getPost('name'),
            'price'  => $this->request->getPost('price'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/admin/product');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $productModel->delete($id);

        return redirect()->to('/admin/product');
    }
    public function products()
{
    return view('admin/products');
}

}
