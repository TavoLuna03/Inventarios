<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    public function index()
    {
        return new OrderCollection(Order::all());
    }

    public function show($id)
    {
        return new OrderResource(Order::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $player = Order::create($request->all());

        return (new OrderResource($player))
                ->response()
                ->setStatusCode(201);
    }

    public function answer($id, Request $request)
    {
        $request->merge(['correct' => (bool) json_decode($request->get('correct'))]);
        $request->validate([
            'correct' => 'required|boolean'
        ]);

        $player = Order::findOrFail($id);
        $player->answers++;
        $player->points = ($request->get('correct')
                           ? $player->points + 1
                           : $player->points - 1);
        $player->save();

        return new OrderResource($player);
    }

    public function delete($id)
    {
        $player = Order::findOrFail($id);
        $player->delete();

        return response()->json(null, 204);
    }

    public function resetAnswers($id)
    {
        $player = Order::findOrFail($id);
        $player->answers = 0;
        $player->points = 0;

        return new OrderRePlayerResourcesource($player);
    }
}
