<?php

namespace App\Http\Controllers\Admin;
use App\Models\Game;
use Validator;
use App\Http\Resources\Games as GamesResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    //View sp
    public function index()
    {
        $games = Game::all();
        $arr = [
            'status' => true,
            'message' => 'Danh sách Games',
            'data' => GamesResource::collection($games)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // Thêm sp
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255|unique:games,name', // Tên game: bắt buộc, chuỗi, tối đa 255 ký tự, duy nhất
            'price' => 'required|numeric|min:0', // Giá: bắt buộc, số, không âm
            'sale' => 'required|numeric|min:0', // Giảm giá (%): bắt buộc, số, từ 0-100 -- |max:100
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh: bắt buộc, định dạng ảnh, tối đa 2MB -----
            'video' => 'nullable', // Video: không bắt buộc, định dạng video, tối đa 10MB---- |mimes:mp4,avi,mov|max:10240
            'short_description' => 'nullable|string|max:500', // Mô tả ngắn: bắt buộc, chuỗi, tối đa 500 ký tự
            'detailed_description' => 'nullable|string', // Mô tả chi tiết: bắt buộc, chuỗi, không giới hạn độ dài
            'status' => 'nullable', // Trạng thái: không bắt buộc
            'category_id' => 'required|integer|exists:gamesgories,id', // ID danh mục: bắt buộc, số nguyên
            'tags' => 'nullable', // Tags: không bắt buộc, dạng mảng (nếu có)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 422);
        }

        // Xử lý file upload
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/bg-img'), $imageName);
            $input['image'] = $imageName;
        }

        $games = Game::create($input);
        return response()->json([
            'status' => true,
            'message' => 'Game đã lưu thành công',
            'data' => new GamesResource($games)
        ], 201);
    }

    // Chi tiết sp
    public function show($id)
    {
        $game = Game::find($id);
        if (is_null($game)) {
            $arr = [
                'success' => false,
                'message' => 'Không có Game này',
                'data' => []
            ];
            return response()->json($arr, 404);
        }
        $arr = [
            'status' => true,
            'message' => 'Chi tiết game',
            'data' => new GamesResource($game)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    // Cập nhật sp
    public function update(Request $request, $id)
    {
        $games = Game::withTrashed()->find($id);
        if (is_null($games)) {
            return response()->json([
                'success' => false,
                'message' => 'Game không tồn tại',
                'data' => []
            ], 404);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'nullable|string|max:255|unique:games,name,' . $games->id, // Tên game: bắt buộc, chuỗi, tối đa 255 ký tự, duy nhất
            'price' => 'nullable|numeric|min:0', // Giá: bắt buộc, số, không âm
            'sale' => 'nullable|numeric|min:0', // Giảm giá (%): bắt buộc, số, từ 0-100 -- |max:100
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh: bắt buộc, định dạng ảnh, tối đa 2MB -----
            'video' => 'nullable', // Video: không bắt buộc, định dạng video, tối đa 10MB---- |mimes:mp4,avi,mov|max:10240
            'short_description' => 'nullable|string|max:500', // Mô tả ngắn: bắt buộc, chuỗi, tối đa 500 ký tự
            'detailed_description' => 'nullable|string', // Mô tả chi tiết: bắt buộc, chuỗi, không giới hạn độ dài
            'status' => 'nullable', // Trạng thái: không bắt buộc
            'category_id' => 'nullable|integer|exists:gamesgories,id', // ID danh mục: bắt buộc, số nguyên
            'tags' => 'nullable', // Tags: không bắt buộc, dạng mảng (nếu có)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ], 422);
        }

        // Xử lý file upload nếu có
        if ($request->hasFile('image')) {
            if ($games->image && file_exists(public_path('img/bg-img/' . $games->image))) {
                unlink(public_path('img/bg-img/' . $games->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/bg-img'), $imageName);
            $games->image = $imageName;
        }

        // Cập nhật thông tin game
        $games->name = $input['name'] ?? $games->name;
        $games->price = $input['price'] ?? $games->price;
        $games->sale = $input['sale'] ?? $games->sale;
        // $games->image = $input['image'] ?? $games->image;
        $games->video = $input['video'] ?? $games->video;
        $games->short_description = $input['short_description'] ?? $games->short_description;
        $games->detailed_description = $input['detailed_description'] ?? $games->detailed_description;
        $games->status = $input['status'] ?? $games->status ?? 1;
        $games->category_id = $input['category_id'] ?? $games->category_id;
        $games->tags = $input['tags'] ?? $games->tags;
        $games->save();

        return response()->json([
            'status' => true,
            'message' => 'Game cập nhật thành công',
            'data' => new GamesResource($games)
        ], 200);
    }

    // Xóa sp
    // Xóa mềm
    public function destroy($id)
    {
        $games = Game::withTrashed()->find($id);
        if (is_null($games)) {
            return response()->json([
                'success' => false,
                'message' => 'Game không tồn tại',
                'data' => []
            ], 404);
        }
        $games->delete();
        $arr = [
            'status' => true,
            'message' => 'Sản phẩm đã được xóa',
            'data' => []
        ];
        return response()->json($arr, 200);
    }
    // Khôi phục sp đã xóa
    public function restore($id)
    {
        $games = Game::withTrashed()->find($id);
        if (!$games->exists) {
            return response()->json([
                'success' => false,
                'message' => 'Game không tồn tại',
                'data' => []
            ], 404);
        }
        $games->restore();
        $arr = [
            'status' => true,
            'message' => 'Sản phẩm đã được khôi phục',
            'data' => []
        ];
        return response()->json($arr, 200);
    }
    public function forceDelete($id){
        $games = Game::withTrashed()->find($id);
        if(is_null($games)) {
            return response()->json([
                'status' => false,
                'message' => 'Game không tìm thấy'
            ], 404);
        }
        if (!$games->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Game chưa được xóa mềm. Vui lòng xóa mềm trước khi xóa vĩnh viễn.',
                'data' => []
            ], 400);
        }

        $games->forceDelete();

        return response()->json([
            'status' => true,
            'message' => 'Game đã được xóa vĩnh viễn',
            'data' => []
        ], 200);
    }
}
