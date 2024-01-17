<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseOrderRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function getAll(Order $order)
    {
        $orderData = $order->showAll();

        if ($orderData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $orderData,
                'date_now' => date('Y-m-d')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function getById(Order $order, string $id)
    {
        $orderData = $order->showById($id);

        if ($orderData) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $orderData,
                'date_now' => date('Y-m-d')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function getByKosId(Order $order)
    {
        $kosId = auth()->user()->kos_id;
        $orderData = $order->showByKosId($kosId);

        if ($orderData->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Data ditemukan',
                ],
                'data' => $orderData,
                'date_now' => date('Y-m-d')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function create(OrderRequest $request, Order $order)
    {
        $isAvailableUpdate = version_compare($request->version, env('APP_VERSION'), '<');

        if ($isAvailableUpdate) {
            return response()->json([
                'status' => false,
                'message' => [
                    'update' => 'Aplikasi telah tersedia dalam versi terbaru, silahkan update aplikasi Anda!',
                ],
                'data' => [
                    'update_url' => env('APP_UPDATE_URL'),
                ],
            ]);
        }

        $isCreatedOrder = $order->store($request->all());

        if ($isCreatedOrder) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Order berhasil dibuat',
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Order gagal dibuat',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function close(CloseOrderRequest $request, Order $order)
    {
        $isAvailableUpdate = version_compare($request->version, env('APP_VERSION'), '<');

        if ($isAvailableUpdate) {
            return response()->json([
                'status' => false,
                'message' => [
                    'update' => 'Aplikasi telah tersedia dalam versi terbaru, silahkan update aplikasi Anda!',
                ],
                'data' => [
                    'update_url' => env('APP_UPDATE_URL'),
                ],
            ]);
        }

        $isClosedOrder = $order->close($request->all());

        if ($isClosedOrder) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Order berhasil ditutup',
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Order gagal ditutup',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }

    public function deleteById(Order $order, string $id)
    {
        $isDeletedOrder = $order->destroyById($id);

        if ($isDeletedOrder) {
            return response()->json([
                'status' => true,
                'message' => [
                    'success' => 'Order berhasil dihapus',
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => [
                    'error' => 'Data tidak ditemukan',
                ]
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan pada database atau server',
        ], 500);
    }
}
