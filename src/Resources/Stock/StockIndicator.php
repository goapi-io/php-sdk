<?php
namespace GOAPI\IO\Resources\Stock;

class StockIndicator {

    function __construct(
        public $datetime,
        public $symbol,
        public $open,
        public $high,
        public $low,
        public $close,
        public $volume,
        public $Prev1Open,
        public $Prev2Open,
        public $Prev3Open,
        public $Prev4Open,
        public $Prev5Open,
        public $Prev1Close,
        public $Prev2Close,
        public $Prev3Close,
        public $Prev4Close,
        public $Prev5Close,
        public $Prev1High,
        public $Prev2High,
        public $Prev3High,
        public $Prev4High,
        public $Prev5High,
        public $Prev1Low,
        public $Prev2Low,
        public $Prev3Low,
        public $Prev4Low,
        public $Prev5Low,
        public $change,
        public $changePct,
        public $MA10,
        public $MA20,
        public $MA50,
        public $MA200,
        public $EMA10,
        public $EMA20,
        public $EMA50,
        public $EMA200,
        public $RSI,
        public $Day20MA,
        public $Upper,
        public $Lower,
        public $Day12EMA,
        public $Day26EMA,
        public $MACD,
        public $SignalLine,
        public $StochOSC, // %K
        public $TR,
        public $ATR,
        public $Day9High,
        public $Day9Low,
        public $Day26High,
        public $Day26Low,
        public $Day52High,
        public $Day52Low
    ) {}

    /**
     * Creates a new StockIndicator object from an array.
     *
     * @param array $array The array containing the data for the StockIndicator object.
     * @return StockIndicator The newly created StockIndicator object.
     */
    public static function fromArray($array): StockIndicator {

        return new StockIndicator(
            datetime: $array["datetime"],
            symbol: $array["symbol"],
            open: $array["open"],
            high: $array["high"],
            low: $array["low"],
            close: $array["close"],
            volume: $array["volume"],
            Prev1Open: $array["Prev1Open"],
            Prev2Open: $array["Prev2Open"],
            Prev3Open: $array["Prev3Open"],
            Prev4Open: $array["Prev4Open"],
            Prev5Open: $array["Prev5Open"],
            Prev1Close: $array["Prev1Close"],
            Prev2Close: $array["Prev2Close"],
            Prev3Close: $array["Prev3Close"],
            Prev4Close: $array["Prev4Close"],
            Prev5Close: $array["Prev5Close"],
            Prev1High: $array["Prev1High"],
            Prev2High: $array["Prev2High"],
            Prev3High: $array["Prev3High"],
            Prev4High: $array["Prev4High"],
            Prev5High: $array["Prev5High"],
            Prev1Low: $array["Prev1Low"],
            Prev2Low: $array["Prev2Low"],
            Prev3Low: $array["Prev3Low"],
            Prev4Low: $array["Prev4Low"],
            Prev5Low: $array["Prev5Low"],
            change: $array["change"],
            changePct: $array["change_pct"],
            MA10: $array["MA10"],
            MA20: $array["MA20"],
            MA50: $array["MA50"],
            MA200: $array["MA200"],
            EMA10: $array["EMA10"],
            EMA20: $array["EMA20"],
            EMA50: $array["EMA50"],
            EMA200: $array["EMA200"],
            RSI: $array["RSI"],
            Day20MA: $array["20 Day MA"],
            Upper: $array["Upper"],
            Lower: $array["Lower"],
            Day12EMA: $array["12 Day EMA"],
            Day26EMA: $array["26 Day EMA"],
            MACD: $array["MACD"],
            SignalLine: $array["Signal Line"],
            StochOSC: $array["%K"],
            TR: $array["TR"],
            ATR: $array["ATR"],
            Day9High: $array["9 Day High"],
            Day9Low: $array["9 Day Low"],
            Day26High: $array["26 Day High"],
            Day26Low: $array["26 Day Low"],
            Day52High: $array["52 Day High"],
            Day52Low: $array["52 Day Low"]        
        );
    }

    /**
     * Generates an array of objects from an array list.
     *
     * @param array $arrayList The array list to generate objects from.
     * @return array The array of generated objects.
     */
    public static function fromArrayList($arrayList): array {

        return array_map(function ($array) {
            return self::fromArray($array);
        }, $arrayList);
    }
}