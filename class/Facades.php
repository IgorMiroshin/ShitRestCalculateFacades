<?php


class Facades
{
    const IBLOCK_ID_PRODUCT = 2;
    const SECTION_ID_MATERIALS = ["20017", "20070"];
    const SECTION_ID_MIRRORS = ["20133"];
    const SECTION_ID_MAIN = ["20012", "20133"];

    const IBLOCK_ID_FACADES = 22;
    const SECTION_ID_FACADES_SERVICES_TYPE_MILLING = 23186;
    const SECTION_ID_FACADES_SERVICES_TYPE_DRILLING = 23185;
    const SECTION_ID_FACADES_SERVICES_PROFILES = 23183;

    public static function getMaterials(): array
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            return [];
        }
        $result = [];
        $sectionsIdMain = self::SECTION_ID_MAIN;

        $arSort = ["NAME" => 'ASC'];
        $arFilter = [
            "IBLOCK_ID" => self::IBLOCK_ID_PRODUCT, "SECTION_ID" => self::SECTION_ID_MATERIALS,
            "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y",
            "=PROPERTY_TOLSHCHINA_MM_VALUE" => 10, "!PROPERTY_FORMAT_LISTA_D_KH_SH" => false
        ];
        $arSelect = [
            "ID", "NAME", "DETAIL_PICTURE", "IBLOCK_SECTION_ID",
            "PROPERTY_CML2_ARTICLE", "PROPERTY_DEKOR",
        ];
        $materialsGetList = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            false,
            $arSelect
        );
        while ($materialsGetListItem = $materialsGetList->GetNext()) {
            $result[(string)$materialsGetListItem["ID"]] = [
                "id" => (integer)$materialsGetListItem["ID"],
                "cat" => $sectionsIdMain[0],
                "article" => (integer)$materialsGetListItem["ID"],
                "articleItem" => (integer)$materialsGetListItem["PROPERTY_CML2_ARTICLE_VALUE"],
                "decor" => $materialsGetListItem["PROPERTY_PROPERTY_DEKOR_VALUE"],
                "title" => $materialsGetListItem["PROPERTY_CML2_ARTICLE_VALUE"] . ' ' . str_replace('&quot;', "\"", $materialsGetListItem["NAME"]),
                "img" => CFile::GetPath($materialsGetListItem["DETAIL_PICTURE"])
            ];
        }

        return $result;
    }

    public static function getMirrors(): array
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            return [];
        }

        $result = [];
        $sectionsIdMain = self::SECTION_ID_MAIN;
        $arSort = ["NAME" => 'ASC'];
        $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_PRODUCT, "ACTIVE" => "Y", "SECTION_ID" => self::SECTION_ID_MIRRORS, "INCLUDE_SUBSECTIONS" => "Y"];
        $arSelect = [
            "ID", "NAME", "DETAIL_PICTURE", "IBLOCK_SECTION_ID",
            "PROPERTY_CML2_ARTICLE", "PROPERTY_DEKOR",
        ];
        $mirrorsGetList = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            false,
            $arSelect
        );
        while ($mirrorsGetListItem = $mirrorsGetList->GetNext()) {
            $result[(string)$mirrorsGetListItem["ID"]] = [
                "id" => (integer)$mirrorsGetListItem["ID"],
                "cat" => $sectionsIdMain[1],
                "article" => (integer)$mirrorsGetListItem["ID"],
                "articleItem" => (integer)$mirrorsGetListItem["PROPERTY_CML2_ARTICLE_VALUE"],
                "decor" => $mirrorsGetListItem["PROPERTY_PROPERTY_DEKOR_VALUE"],
                "title" => $mirrorsGetListItem["PROPERTY_CML2_ARTICLE_VALUE"] . ' ' . str_replace('&quot;', "\"", $mirrorsGetListItem["NAME"]),
                "img" => CFile::GetPath($mirrorsGetListItem["DETAIL_PICTURE"])
            ];
        }
        return $result;
    }

    public static function getCategories(): array
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            return [];
        }
        $result = [];

        $sectionsIdMain = self::SECTION_ID_MAIN;
        $arSort = ["NAME" => 'ASC'];
        $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_PRODUCT, "ACTIVE" => "Y", "ID" => $sectionsIdMain, "INCLUDE_SUBSECTIONS" => "N"];
        $arSelect = [
            "ID", "NAME", "DETAIL_PICTURE", "IBLOCK_SECTION_ID",
            "PROPERTY_CML2_ARTICLE", "PROPERTY_DEKOR",
        ];
        $categoriesGetList = CIBlockSection::GetList(
            $arSort,
            $arFilter,
            false,
            $arSelect,
            false,

        );
        while ($categoriesGetListItem = $categoriesGetList->GetNext()) {
            $result[$categoriesGetListItem["ID"]] = [
                "id" => $categoriesGetListItem["ID"],
                "name" => $categoriesGetListItem["NAME"],
                "engraving" => false
            ];
        }
        return $result;
    }

    public static function getTypeMilling(): array
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            return [];
        }

        $result = [];
        $arSort = ["SORT" => 'ASC'];
        $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_FACADES, "ACTIVE" => "Y", "SECTION_ID" => self::SECTION_ID_FACADES_SERVICES_TYPE_MILLING, "INCLUDE_SUBSECTIONS" => "Y"];
        $arSelect = [
            "ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_MIN_COUNT_HOLL", "PROPERTY_MAX_COUNT_HOLL"
        ];
        $typeMillingGetList = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            false,
            $arSelect
        );
        while ($typeMillingGetListItem = $typeMillingGetList->GetNext()) {
            $result[(string)$typeMillingGetListItem["ID"]] = [
                "id" => (integer)$typeMillingGetListItem["ID"],
                "minQuantity" => (integer)$typeMillingGetListItem["PROPERTY_MIN_COUNT_HOLL_VALUE"],
                "maxQuantity" => (integer)$typeMillingGetListItem["PROPERTY_MAX_COUNT_HOLL_VALUE"],
                "title" => $typeMillingGetListItem["NAME"],
                "img" => CFile::GetPath($typeMillingGetListItem["PREVIEW_PICTURE"])
            ];
        }
        return $result;
    }

    public static function getTypeDrilling(): array
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            return [];
        }

        $result = [];
        $arSort = ["SORT" => 'ASC'];
        $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_FACADES, "ACTIVE" => "Y", "SECTION_ID" => self::SECTION_ID_FACADES_SERVICES_TYPE_DRILLING, "INCLUDE_SUBSECTIONS" => "Y"];
        $arSelect = [
            "ID", "NAME"
        ];
        $typeMillingGetList = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,
            false,
            $arSelect
        );
        while ($typeMillingGetListItem = $typeMillingGetList->GetNext()) {
            $result[(string)$typeMillingGetListItem["ID"]] = [
                "id" => (integer)$typeMillingGetListItem["ID"],
                "title" => $typeMillingGetListItem["NAME"],
            ];
        }
        return $result;
    }

    public static function getProfiles(): array
    {
        if (!\Bitrix\Main\Loader::includeModule('iblock')) {
            return [];
        }

        $result = [];
        $arSort = ["SORT" => 'ASC'];
        $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_FACADES, "ACTIVE" => "Y", "SECTION_ID" => self::SECTION_ID_FACADES_SERVICES_PROFILES, "INCLUDE_SUBSECTIONS" => "Y"];
        $arSelect = [
            "ID", "NAME", "PICTURE", "UF_TYPE_MILLINGS"
        ];
        $profilesCategoriesGetList = CIBlockSection::GetList(
            $arSort,
            $arFilter,
            false,
            $arSelect,
            false,
        );
        while ($profilesCategoriesGetListItem = $profilesCategoriesGetList->GetNext()) {
            $result[(string)$profilesCategoriesGetListItem["ID"]] = [
                "id" => $profilesCategoriesGetListItem["ID"],
                "title" => $profilesCategoriesGetListItem["NAME"],
                "millings" => $profilesCategoriesGetListItem["UF_TYPE_MILLINGS"],
                "img" => CFile::GetPath($profilesCategoriesGetListItem["PICTURE"]),
                "sheme" => CFile::GetPath($profilesCategoriesGetListItem["PICTURE"]),
            ];

            $arSort = ["SORT" => 'ASC'];
            $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_FACADES, "ACTIVE" => "Y", "SECTION_ID" => $profilesCategoriesGetListItem["ID"]];
            $arSelect = [
                "ID", "NAME", "PREVIEW_PICTURE", "CATALOG_PRICE_1"
            ];
            $profilesElementsGetList = CIBlockElement::GetList(
                $arSort,
                $arFilter,
                false,
                false,
                $arSelect
            );

            while ($profilesElementsGetListItem = $profilesElementsGetList->GetNext()) {
                $result[(string)$profilesCategoriesGetListItem["ID"]]["color"][] = [
                    "id" => (integer)$profilesElementsGetListItem["ID"],
                    "title" => $profilesElementsGetListItem["NAME"],
                    "img" => CFile::GetPath($profilesElementsGetListItem["PREVIEW_PICTURE"]),
                    "price" => $profilesElementsGetListItem["CATALOG_PRICE_1"]
                ];
            }
        }
        return $result;
    }

    public static function GetDataObject($method)
    {
        $arrayMethod = [
            'getMaterials' => self:: getMaterials(),
            'getMirrors' => self:: getMirrors(),
            'getCategories' => self:: getCategories(),
            'getTypeMilling' => self:: getTypeMilling(),
            'getTypeDrilling' => self:: getTypeDrilling(),
            'getProfiles' => self:: getProfiles(),
        ];

        return json_encode($arrayMethod[$method]);
    }
}