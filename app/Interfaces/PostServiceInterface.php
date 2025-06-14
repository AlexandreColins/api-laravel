<?php

namespace App\Interfaces;

interface PostServiceInterface
{
    public function listPosts();
    public function getPost($id);
    public function createPost(array $data);
    public function updatePost($id, array $data);
    public function deletePost($id);
}
