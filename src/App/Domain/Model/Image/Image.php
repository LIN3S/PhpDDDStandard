<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Model\Image;

use BenGorFile\File\Domain\Model\File;

class Image extends File
{
    public static function availableMimeTypes()
    {
        return [
            'image/x-3ds',
            'image/x-ms-bmp',
            'image/prs.btif',
            'image/cgm',
            'image/x-cmx',
            'image/vnd.djvu',
            'image/vnd.djvu',
            'image/vnd.dwg',
            'image/vnd.dxf',
            'image/vnd.fastbidsheet',
            'image/x-freehand',
            'image/x-freehand',
            'image/x-freehand',
            'image/x-freehand',
            'image/x-freehand',
            'image/vnd.fpx',
            'image/vnd.fst',
            'image/g3fax',
            'image/gif',
            'image/x-icon',
            'image/ief',
            'image/jpeg',
            'image/jpeg',
            'image/jpeg',
            'image/ktx',
            'image/vnd.ms-modi',
            'image/vnd.fujixerox.edmics-mmr',
            'image/vnd.net-fpx',
            'image/x-portable-bitmap',
            'image/x-pict',
            'image/x-pcx',
            'image/x-portable-graymap',
            'image/x-pict',
            'image/png',
            'image/x-portable-anymap',
            'image/x-portable-pixmap',
            'image/vnd.adobe.photoshop',
            'image/x-cmu-raster',
            'image/x-rgb',
            'image/sgi',
            'image/x-mrsid-image',
            'image/svg+xml',
            'image/svg+xml',
            'image/x-tga',
            'image/tiff',
            'image/tiff',
            'image/vnd.dece.graphic',
            'image/vnd.dece.graphic',
            'image/vnd.dece.graphic',
            'image/vnd.dece.graphic',
            'image/vnd.wap.wbmp',
            'image/vnd.ms-photo',
            'image/webp',
            'image/x-xbitmap',
            'image/vnd.xiff',
            'image/x-xpixmap',
            'image/x-xwindowdump',
        ];
    }

}
