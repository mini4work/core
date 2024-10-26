<?php

namespace Miniwork\Enums;

enum ConsoleStyles: string
{
    // Formatting
    case FormatBoldOn = "\e[1m";
    case FormatBoldOff = "\e[21m";
    case FormatItalicOn = "\e[3m";
    case FormatItalicOff = "\e[23m";
    case FormatUnderlineOn = "\e[4m";
    case FormatUnderlineOff = "\e[24m";
    case FormatBlinkOn = "\e[5m";
    case FormatBlinkOff = "\e[25m";
    case FormatReverseOn = "\e[7m"; // Swap background and text color
    case FormatReverseOff = "\e[27m"; // Swap background and text color
    case FormatStrikethroughOn = "\e[9m";
    case FormatStrikethroughOff = "\e[29m";

    // Text Colors
    case TextBlack = "\e[30m";
    case TextRed = "\e[31m";
    case TextGreen = "\e[32m";
    case TextYellow = "\e[33m";
    case TextBlue = "\e[34m";
    case TextMagenta = "\e[35m";
    case TextCyan = "\e[36m";
    case TextGrayLight = "\e[37m";
    case TextDefault = "\e[39m";
    case TextGrayDark = "\e[90m";
    case TextRedLight = "\e[91m";
    case TextGreenLight = "\e[92m";
    case TextYellowLight = "\e[93m";
    case TextBlueLight = "\e[94m";
    case TextMagentaLight = "\e[95m";
    case TextCyanLight = "\e[96m";
    case TextWhite = "\e[97m";

    // BackgroundColors
    case BgBlack = "\e[40m";
    case BgRed = "\e[41m";
    case BgGreen = "\e[42m";
    case BgYellow = "\e[43m";
    case BgBlue = "\e[44m";
    case BgMagenta = "\e[45m";
    case BgCyan = "\e[46m";
    case BgGrayLight = "\e[47m";

    // Removing characters
    case CharBackspace = "\e1P";
    case CharBackspaceNoMoveCursor = "\e1X";
    case CharRemoveLine = "\e1M";

    case ClearScreen = "\e[H\e[2J";
    case ResetAllAttributes = "\e(B\e[m";
}
