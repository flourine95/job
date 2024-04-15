<?php

namespace App\Imports;

use App\Enums\FileTypeEnum;
use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostsImport implements ToArray, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */

    public function array(array $array)
    {
        try {
            foreach ($array as $value) {
                $companyName = $value['cong_ty'];
                $languages = $value['ngon_ngu'];
                $city = $value['dia_diem'];
                $link = $value['link'];
                $company = Company::query()->firstOrCreate([
                    'name' => $companyName,
                ], [
                    'city' => $city,
                    'country' => 'Vietnam',
                ]);
                foreach (explode(',', $languages) as $language) {
                    Language::query()->firstOrCreate([
                        'name' => trim($language),
                    ]);
                }
                $post = Post::query()->create([
                    'job_title' => $languages . '-' . $city,
                    'city' => $city,
                    'status' => PostStatusEnum::ADMIN_APPROVED,
                    'company_id' => $company->id,
                ]);
                File::query()->create([
                    'link' => $link,
                    'type' => FileTypeEnum::JD,
                    'post_id' => $post->id,
                ]);
            }

        } catch (Exception $e) {
            return $value;
        }

    }

}
