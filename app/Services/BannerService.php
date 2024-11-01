<?php

namespace App\Services;

use App\Traits\FileManagerTrait;

class BannerService
{
    use FileManagerTrait;

    public function getProcessedData(object $request, string $image = null): array
    {
        if ($image) {
            $imageName = $request->file('image') ? $this->update(dir:'banner/', oldImage:$image, format: 'webp', image: $request->file('image')) : $image;
            if($request->file('mobile_photo')){
                $ImageMobile = $request->file('mobile_photo') ? $this->update(dir:'banner/', oldImage:$image, format: 'webp', image: $request->file('mobile_photo')) : $image;
            }
        }else {
            $imageName = $this->upload(dir:'banner/', format: 'webp', image: $request->file('image'));
            if($request->file('mobile_photo')){
                $ImageMobile = $this->upload(dir:'banner/', format: 'webp', image: $request->file('mobile_photo'));
            }
        }
        
        

        return [
            'banner_type' => $request['banner_type'],
            'resource_type' => $request['resource_type'],
            'resource_id' => $request[$request->resource_type . '_id'],
            'theme' => theme_root_path(),
            'title' => $request['title'],
            'sub_title' => $request['sub_title'],
            'button_text' => $request['button_text'],
            'background_color' => $request['background_color'],
            'url' => $request['url'] ?? '',
            'photo' => $imageName,
            'mobile_photo' => $request->file('mobile_photo') ? $ImageMobile : null,
        ];
    }

    public function getBannerTypes(): array
    {
        $isReactActive = getWebConfig(name: 'react_setup')['status'];
        $bannerTypes = [];
        if (theme_root_path() == 'default') {
            $bannerTypes = [
                "Main Banner" => translate('main_Banner'),
                "Popup Banner" => translate('popup_Banner'),
                "Footer Banner" => translate('footer_Banner'),
                "Main Section Banner" => translate('main_Section_Banner'),
                "Parent Banner" => translate('parent_Banner')
            ];

        }elseif (theme_root_path() == 'theme_aster') {
            $bannerTypes = [
                "Main Banner" => translate('main_Banner'),
                "Popup Banner" => translate('popup_Banner'),
                "Footer Banner" => translate('footer_Banner'),
                "Main Section Banner" => translate('main_Section_Banner'),
                "Header Banner" => translate('header_Banner'),
                "Sidebar Banner" => translate('sidebar_Banner'),
                "Top Side Banner" => translate('top_Side_Banner'),
                "Parent Banner" => translate('parent_Banner'),
            ];
        }elseif (theme_root_path() == 'theme_fashion') {
            $bannerTypes = [
                "Main Banner" => translate('main_Banner'),
                "Popup Banner" => translate('popup_Banner'),
                "Promo Banner Left" => translate('promo_banner_left'),
                "Promo Banner Middle Top" => translate('promo_banner_middle_top'),
                "Promo Banner Middle Bottom" => translate('promo_banner_middle_bottom'),
                "Promo Banner Right" => translate('promo_banner_right'),
                "Promo Banner Bottom" => translate('promo_banner_bottom'),
                "Parent Banner" => translate('parent_banner'),
                "Alert Banner" => translate("alert_banner"),
                "Promo Deal Banner" => translate("promo_deal_banner"),
                "Season Banner" => translate("season_banner"),
                "Trends Banner" => translate("trends_banner"),
                "Brand Banner" => 'Brand Banner',
            ];
        }

        if($isReactActive){
            $reactBanner = [
                'Main Banner' => translate('main_Banner'),
                'Main Section Banner' => translate('main_Section_Banner'),
                'Top Side Banner' => translate('top_Side_Banner'),
                'Footer Banner' => translate('footer_Banner'),
                'Popup Banner' => translate('popup_Banner'),
                'Parent Banner' => translate('parent_Banner'),
            ];
            $bannerTypes = array_unique(array_merge($bannerTypes, $reactBanner));
        }

        return $bannerTypes;
    }

}
