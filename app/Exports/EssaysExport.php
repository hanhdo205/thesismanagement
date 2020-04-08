<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EssaysExport implements FromCollection, WithHeadings, WithMapping {
	protected $essays;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct($essays) {
		$this->essays = explode(',', $essays);
	}
	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function collection() {
		DB::statement(DB::raw("SET @row = '0'"));
		$rows = DB::table('essays')
			->whereIn('id', $this->essays)
			->select(DB::raw("@row:=@row+1 AS no"), 'essay_title', 'student_name', 'review_status', 'review_result', 'created_at')
			->get();
		return $rows;
	}
	/**
	 * Returns headers for report
	 * @return array
	 */
	public function headings(): array{
		return [
			'No',
			'タイトル',
			'氏名',
			'ステータス',
			'査読結果',
			'提出日',
		];
	}

	public function map($essay): array{
		return [
			$essay->no,
			$essay->essay_title,
			$essay->student_name,
			_i($essay->review_status),
			_i($essay->review_result),
			date_format(date_create($essay->created_at), "Y年m月d日"),
		];
	}
}
