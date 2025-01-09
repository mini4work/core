<?php

namespace M4W\Enums;

enum ConsoleStyles: string
{
    // Formatting
    case FormatBoldOn = "1";
    case FormatBoldOff = "21";
    case FormatItalicOn = "3";
    case FormatItalicOff = "23";
    case FormatUnderlineOn = "4";
    case FormatUnderlineOff = "24";
    case FormatBlinkOn = "5";
    case FormatBlinkOff = "25";
    case FormatReverseOn = "7"; // Swap background and text color
    case FormatReverseOff = "27"; // Swap background and text color
    case FormatStrikethroughOn = "9";
    case FormatStrikethroughOff = "29";

    // Text Colors
    case TextBlack = "30";
    case TextRed = "31";
    case TextGreen = "32";
    case TextYellow = "33";
    case TextBlue = "34";
    case TextMagenta = "35";
    case TextCyan = "36";
    case TextGrayLight = "37";
    case TextDefault = "39";
    case TextGrayDark = "90";
    case TextRedLight = "91";
    case TextGreenLight = "92";
    case TextYellowLight = "93";
    case TextBlueLight = "94";
    case TextMagentaLight = "95";
    case TextCyanLight = "96";
    case TextWhite = "97";

    // BackgroundColors
    case BgBlack = "40";
    case BgRed = "41";
    case BgGreen = "42";
    case BgYellow = "43";
    case BgBlue = "44";
    case BgMagenta = "45";
    case BgCyan = "46";
    case BgGrayLight = "47";
    case BgGrayDark = "100";
    case BgRedLight = "101";
    case BgGreenLight = "102";
    case BgYellowLight = "103";
    case BgBlueLight = "104";
    case BgMagentaLight = "105";
    case BgCyanLight = "106";
    case BgWhite = "107";

    public function format(): string
    {
        return "\e[" . $this->value . "m";
    }

    public static function resetAllAttributes(): string
    {
        return "\e(B\e[m";
    }

    public static function clearScreen(): string
    {
        return "\e[H\e[2J";
    }

    public static function applyStyles(array $syles): string
    {
        $stylesValuesArray = [];
        foreach ($syles as $style) {
            $stylesValuesArray[] = $style->value;
        }
        return "\e[" . implode(";", $stylesValuesArray) . "m";
    }
}
