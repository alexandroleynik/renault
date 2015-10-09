<?php

namespace common\models\locale;
use common\models\Finance;

/**
 * This is the model class for table "model".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property string $head
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property array $attachments
 * @property integer $author_id
 * @property integer $updater_id
 * @property integer $category_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $weight
 *
 * @property User $author
 * @property User $updater
 * @property ModelCategory $category
 * @property ModelAttachment[] $modelAttachments
 */
class FinanceUkUA extends Finance
{
    
}