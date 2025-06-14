<?php

namespace App\Services;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listPosts()
    {
        return $this->postRepository->all();
    }

    public function getPost($id)
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data)
    {
        return $this->postRepository->create($data);
    }

    public function updatePost($id, array $data)
    {
        return $this->postRepository->update($id, $data);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }
}
