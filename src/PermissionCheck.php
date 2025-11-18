<?php

namespace MediaWiki\Extension\VideoPermissions;

use MediaWiki\Hook\UploadVerifyUploadHook;
use User;
use UploadBase;

class PermissionCheck implements UploadVerifyUploadHook {
    public function onUploadVerifyUpload (UploadBase $upload, User $user, ?array $props, $comment, $pageText, &$error) {
        $title = $upload->getTitle();
        if ($props['mime'] !== 'video/mp4' || $user->definitelyCan('upload-videos', $title)) {
            return;
        } else {
            if ($user->definitelyCan('not-upload-videos', $title)) {
                $error = 'videopermission-no-perm-to-upload';
                return false;
            } 
        }
    }
}