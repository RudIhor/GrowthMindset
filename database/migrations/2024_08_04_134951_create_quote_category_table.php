<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $quotes = DB::table('quotes')->select(['id', 'category_id'])->get();
        Schema::create('quote_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained('quotes')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
        });
        foreach ($quotes as $quote) {
            DB::table('quote_category')->insert([
                'quote_id' => $quote->id,
                'category_id' => $quote->category_id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $items = DB::table('quote_category')->select(['quote_id', 'category_id'])->get();
        foreach ($items as $item) {
            DB::table('quotes')->where('id', $item->quote_id)->update(['category_id' => $item->category_id]);
        }
        Schema::dropIfExists('quote_category');
    }
};
