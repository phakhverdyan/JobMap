<?php

namespace App;

class Emoji
{
	function __construct() {
		$data = json_decode(file_get_contents(__dir__ . '/Emoji.json'));
		$this->data = [];

		foreach ($data as $data_emoji) {
			$emoji = (object) [
				'title' 	=> $data_emoji->title,
				'code' 		=> $data_emoji->code,
				'source' 	=> $data_emoji->source,
				'position' 	=> $data_emoji->position,
			];

			if (!isset($this->data[$data_emoji->category])) {
				$this->data[$data_emoji->category] = [];
			}

			$this->data[$data_emoji->category][] = $emoji;
		}
	}

	function getCategories() {
		return array_map(function($category_name) {
			return (object) [
				'name' => $category_name,
				'emojis' => $this->data[$category_name],
			];
		}, array_keys($this->data));
	}

	function getEmoji() {
		$emojis = [];

		foreach ($this->data as $category_emojis) {
			$emojis = array_merge($emojis, $category_emojis);
		}

		return $emojis;
	}
}