<?php
namespace GOAPI\IO\Resources;

class StockIndicator {
    /**
     * Constructs a new instance of the class.
     *
     * @param mixed $datetime The datetime value.
     * @param mixed $symbol The symbol value.
     * @param mixed $open The open value.
     * @param mixed $high The high value.
     * @param mixed $low The low value.
     * @param mixed $close The close value.
     * @param mixed $volume The volume value.
     * @param mixed $Prev1 The Prev1 value.
     * @param mixed $Prev2 The Prev2 value.
     * @param mixed $Prev3 The Prev3 value.
     * @param mixed $Prev4 The Prev4 value.
     * @param mixed $Prev5 The Prev5 value.
     * @param mixed $change The change value.
     * @param mixed $changePct The changePct value.
     * @param mixed $MA10 The MA10 value.
     * @param mixed $MA20 The MA20 value.
     * @param mixed $MA50 The MA50 value.
     * @param mixed $MA200 The MA200 value.
     * @param mixed $EMA10 The EMA10 value.
     * @param mixed $EMA20 The EMA20 value.
     * @param mixed $EMA50 The EMA50 value.
     * @param mixed $EMA200 The EMA200 value.
     * @param mixed $RSI The RSI value.
     * @param mixed $Day20MA The Day20MA value.
     * @param mixed $Upper The Upper value.
     * @param mixed $Lower The Lower value.
     * @param mixed $Day12EMA The Day12EMA value.
     * @param mixed $Day26EMA The Day26EMA value.
     * @param mixed $MACD The MACD value.
     * @param mixed $SignalLine The SignalLine value.
     * @param mixed $StochOSC The StochOSC value.
     * @param mixed $TR The TR value.
     * @param mixed $ATR The ATR value.
     * @param mixed $Day9High The Day9High value.
     * @param mixed $Day9Low The Day9Low value.
     * @param mixed $Day26High The Day26High value.
     * @param mixed $Day26Low The Day26Low value.
     * @param mixed $Day52High The Day52High value.
     * @param mixed $Day52Low The Day52Low value.
     */
    function __construct(
        public $datetime,
        public $symbol,
        public $open,
        public $high,
        public $low,
        public $close,
        public $volume,
        public $Prev1,
        public $Prev2,
        public $Prev3,
        public $Prev4,
        public $Prev5,
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
            Prev1: $array["Prev1"],
            Prev2: $array["Prev2"],
            Prev3: $array["Prev3"],
            Prev4: $array["Prev4"],
            Prev5: $array["Prev5"],
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