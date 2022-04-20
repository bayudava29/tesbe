<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Exceptions\ServerError;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @group Post
 * @unauthenticated
 */
class PostController extends Controller
{
    /**
     * Store new article
     * @bodyParam title string required
     * @bodyParam content text required
     * @bodyParam category string required
     * @bodyParam status string required
     */
    public function storeArticle(Request $request)
    {
        $model = new Post;
        $model->fill($request->input());

        $validation = $model->validate();
        if ($validation->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation fails',
                'data' => ['errors' => $validation->errors()]
            ]);
        }

        try {
            $model->save();
        } catch (Exception $e) {
            throw new ServerError($e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully store data',
            'data' => $model
        ], 200);
    }

    /**
     * Get All Article
     * @queryParam page[size] integer
     * @queryParam page[number] integer
     * @queryParam filter[category] string this for filtering data by category
     * @queryParam sort string ex: sort=-created_at for descending by created_at
     */
    public function getAllArticle()
    {
        $model = QueryBuilder::for(Post::class)
            ->allowedSorts('created_at')
            ->allowedFilters('status')
            ->jsonPaginate()->appends(Request()->input());
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully get data',
            'data' => $model
        ]);
    }

    /**
     * Find article by id
     * @urlParam id integer
     */
    public function findArticle($id)
    {
        $model = Post::find($id);
        if (!$model) {
            throw new DataNotFound;
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully get data',
            'data' => $model
        ]);
    }

    /**
     * Update article
     * @urlParam id integer required
     * @bodyParam title string
     * @bodyParam content text
     * @bodyParam category string
     * @bodyParam status string required
     */
    public function updateArticle(Request $request)
    {
        $model = Post::find($request->id);
        if (!$model) {
            throw new DataNotFound;
        }
        $model->fill($request->except('id'));

        $validation = $model->validate();
        if ($validation->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation fails',
                'data' => ['errors' => $validation->errors()]
            ]);
        }

        try {
            $model->save();
        } catch (Exception $e) {
            throw new ServerError($e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully update data',
            'data' => $model
        ]);
    }

    /**
     * Delete article
     * @urlParam id integer required
     */
    public function deleteArticle(Request $request)
    {
        $model = Post::find($request->id);
        if (!$model) {
            throw new DataNotFound;
        }

        try {
            $model->delete();
        } catch (Exception $e) {
            throw new ServerError($e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully delete data',
            'data' => []
        ]);
    }
}
