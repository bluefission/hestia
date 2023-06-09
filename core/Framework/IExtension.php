<?php
namespace BlueFission\Framework;

interface IExtension {
	public function init();
	public function name();
}