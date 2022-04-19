<?php

namespace App\Models;

class Post extends BaseModel
{
    protected $table = 'posts';
    protected $guarded = ['id'];

    /**
     * value of status
     */
    const PUBLISH = 'publish';
    const DRAFT = 'draft';
    const THRASH = 'thrash';

    public function rules()
    {
        return [
            'title' => 'required|min:20',
            'content' => 'required|min:200',
            'category' => 'required|min:3',
            'status' => 'required|in:' . self::PUBLISH . ',' . self::DRAFT . ',' . self::THRASH . ''
        ];
    }

    public function attributesLabel()
    {
        return [
            'title' => 'Title',
            'content' => 'Content',
            'category' => 'Category'
        ];
    }
}
