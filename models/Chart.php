<?php

class Chart{
    public array $labels;
    public array $values;
    public string $chartTitle;

    public function __construct(array $labels, array $values, string $chartTitle) {
        $this->labels = $labels;
        $this->values = $values;
        $this->chartTitle = $chartTitle;
    }

    public function toArray(): array {
        return [
            'labels' => $this->labels,
            'values' => $this->values,
            'chartTitle' => $this->chartTitle,
        ];
    }

    public function toJSON(): string {
        return json_encode($this->toArray());
    }
}
?>
