<?php

namespace App\Enum;

enum PostStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::ARCHIVED => 'Archived',
        };
    }

    public function isDraft(): bool
    {
        return $this === self::DRAFT;
    }

    public function isArchived(): bool
    {
        return $this === self::ARCHIVED;
    }

    public function isPublished(): bool
    {
        return $this === self::PUBLISHED;
    }

    public static function list(): array
    {
        return [
            self::DRAFT,
            self::PUBLISHED,
            self::ARCHIVED,
        ];
    }
}
