<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Game;
use Validator;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CateController extends Controller
{
    //Hiển thị danh sách danh mục
    public function index()
    {
        $cate = Category::all();
        return response()->json([
            'status' => true,
            'message' => 'Danh sách danh mục',
            'data' => CategoryResource::collection($cate)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    //Thêm danh mục
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255|unique:categories,name', // Tên danh mục: bắt buộc, chuỗi, tối đa 255 ký tự, duy nhất
            'description' => 'nullable|string|max:500', // Mô tả: không bắt buộc, chuỗi, tối đa 500 ký tự
            'status' => 'nullable', // Trạng thái: không bắt buộc
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 422);
        }
        $cate = Category::create($input);
        return response()->json([
            'status' => true,
            'message' => 'Danh mục đã lưu thành công',
            'data' => new CategoryResource($cate)
        ], 201);
    }

    //Chi tiết danh mục
    public function show( $id)
    {
        $cate = Category::find($id);
        if(is_null($cate)) {
            return response()->json([
                'status' => false,
                'message' => 'Danh mục không tìm thấy'
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Danh mục tìm thấy',
                'data' => new CategoryResource($cate)
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    //Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $cate = Category::withTrashed()->find($id);
        if(is_null($cate)) {
            return response()->json([
                'status' => false,
                'message' => 'Danh mục không tìm thấy'
            ], 404);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'nullable|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string|max:500',
            'status' => 'nullable'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 422);
        }

        $cate->name = $input['name'] ?? $cate->name;
        $cate->description = $input['description'] ?? $cate->description;
        $cate->status = $input['status'] ?? $cate->status ?? 1;
        $cate->save();
        return response()->json([
            'status' => true,
            'message' => 'Danh mục cập nhật thành công',
            'data' => new CategoryResource($cate)
        ], 200);
    }

    // Xóa danh mục
    public function destroy(string $id)
    {
        $cate = Category::find($id);
        if(is_null($cate)) {
            return response()->json([
                'status' => false,
                'message' => 'Danh mục không tìm thấy'
            ], 404);
        }
        $cate->delete();
        return response()->json([
            'status' => true,
            'message' => 'Danh mục đã xóa thành công'
        ], 200);
    }
    // Khôi phục danh mục đã xóa
    public function restore($id)
    {
        $cate = Category::withTrashed()->find($id);
        if (!$cate->exists) {
            return response()->json([
                'success' => false,
                'message' => 'Danh mục không tồn tại',
                'data' => []
            ], 404);
        }
        $cate->restore();
        return response()->json([
            'status' => true,
            'message' => 'Danh mục đã được khôi phục',
            'data' => []
        ], 200);
    }
    public function forceDelete($id){
        $cate = Category::withTrashed()->find($id);
        if(is_null($cate)) {
            return response()->json([
                'status' => false,
                'message' => 'Danh mục không tìm thấy'
            ], 404);
        }
        if (!$cate->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Danh mục chưa được xóa mềm. Vui lòng xóa mềm trước khi xóa vĩnh viễn.',
                'data' => []
            ], 400);
        }
        $gamesCount = Game::where('category_id', $id)->count();

        if ($gamesCount > 0) {
            Game::where('category_id', $id)->delete();
        }
        $cate->forceDelete();

        return response()->json([
            'status' => true,
            'message' => 'Danh mục đã được xóa vĩnh viễn',
            'data' => []
        ], 200);
    }
}
