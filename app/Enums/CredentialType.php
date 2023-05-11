<?php
namespace App\Enums;

class CredentialType {
    const FTP = "FTP";
    const SFTP = "SFTP";
    const SSH = "SSH";
    const VPN = "VPN";
    const DATABASE = "Database";
    const DEFAULT = "Default";
    const OTHER = "Other";

    public static function cases()
    {
        return [
            static::FTP,
            static::SFTP,
            static::SSH,
            static::VPN,
            static::DATABASE,
            static::DEFAULT,
            static::OTHER,
        ];
    }

    public static function dictionary()
    {
        return [
            static::FTP => __(static::FTP),
            static::SFTP => __(static::SFTP),
            static::SSH => __(static::SSH),
            static::VPN => __(static::VPN),
            static::DATABASE => __(static::DATABASE),
            static::DEFAULT => __(static::DEFAULT),
            static::OTHER => __(static::OTHER),
        ];
    }

    public static function label($case)
    {
        return static::dictionary()[$case] ?? "";
    }
}
