<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            ["It is always later than you think. Don't wait, take action now. It's the shortest way to your dreams", 3, 1],
            ['No effect without effort. Work hard and everything will become easier', 3, 9],
            ["When you can't change the situation any more. Start to change yourself", 3, 5],
            ["To believe in one's ability to act, to face obstacles openly, and to turn feat into more drive. That's where willpower comes from.", 3, 1],
            ["What you don't know, god will send you the problem to teach you the lesson", 4, 3],
            ['Wealth gives you time and therefore freedom-to make money, to give it away, and to be with your loved ones', 4, 4],
            ["Wealth isn't about what you make; it's about how much you keep", 4, 3],
            ['The more precise the goals, the stronger they become. Visualize them in detail. Feel them.', 3, 5],
            ["If you don't have the spiritual warrior in you, I don't care how big or strong you are - you'll never be champion.", 5, 3],
            ['All our dreams can come true, if we have the courage to pursue them.', 13, 1],
            ['Challenges are what make life interesting and overcoming them is what makes life meaningful', 14, 3],
            ['Education is our passport to the future, for tomorrow belongs to the people who prepare for it today', 15, 3],
            ["Never give up on something you really want. It's difficult to wait, but it's more difficult to regret", 19, 1],
            ['Optimism is the ultimate immune system.', 3, 5],
            ["Working hard for something we don't care about is called stress. Working hard for something we love is called passion", 6, 3],
            ["You can't see a reflection in boiling water. Similarly, you can't see the truth in the state of anger. When water calms, clarity comes.", 6, 5],
            ["Some people dream of success while other people get up every morning to make it happen. It's all about mindset.", 6, 3],
            ['Things you can control: habits, attitude, network, work rate, physique', 6, 3],
            ["Ships don't sink because of the water around them, ships sink because of the water that gets in them. Don't let what's happening around you get inside you and weigh you down", 3, 5],
            ['Sometimes courage is the quiet voice at the end of the day saying: I will try tomorrow', 1, 3],
            ['The pain you feel today will be the strength you feel tomorrow', 1, 3],
            ["If you don't value your time, neither will others", 1, 5],
            ['Get up! Otherwise your comfort zone will kill you.', 1, 3],
            ["Don't say to yourself: What's going to happen? Ask yourself: What can I do? Be the driving force of your own life", 3, 3],
            ['(Discipline + Efforts) * Time = Result', 18, 4],
        ];
        array_map(function($quote) {
            DB::table('quotes')->insert([
                'content' => $quote[0],
                'author_id' => $quote[1],
                'category_id' => $quote[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $quotes);
    }
}
