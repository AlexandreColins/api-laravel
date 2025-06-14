<?php

namespace App\Http\Controllers;

use App\Interfaces\PostServiceInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Resources\PostResource;

/**
 * @OA\Tag(
 *     name="Posts",
 *     description="Operações relacionadas a posts"
 * )
 */
class PostController extends Controller
{
    use AuthorizesRequests;

    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Listar posts do usuário autenticado.
     *
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Listar posts do usuário autenticado",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de posts",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->listPosts();
        return response()->json(PostResource::collection($posts));
    }

    /**
     * Criar um novo post.
     *
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Criar um novo post",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","content"},
     *             @OA\Property(property="title", type="string", example="Meu post"),
     *             @OA\Property(property="content", type="string", example="Conteúdo do post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post criado",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = $this->postService->createPost($data);
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Exibir um post específico.
     *
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Exibir um post específico",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do post",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Não autorizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post não encontrado"
     *     )
     * )
     */
    public function show(Post $post): JsonResponse
    {
        $this->authorize('view', $post);
        return response()->json(new PostResource($post));
    }

    /**
     * Atualizar um post.
     *
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     summary="Atualizar um post",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Novo título"),
     *             @OA\Property(property="content", type="string", example="Novo conteúdo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Não autorizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post não encontrado"
     *     )
     * )
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);
        $data = $request->validated();
        $updatedPost = $this->postService->updatePost($post->id, $data);
        return response()->json(new PostResource($updatedPost));
    }

    /**
     * Deletar um post.
     *
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Deletar um post",
     *     tags={"Posts"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Post deletado"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Não autorizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post não encontrado"
     *     )
     * )
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('delete', $post);
        $this->postService->deletePost($post->id);
        return response()->json(null, 204);
    }
}
