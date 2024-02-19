<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertises')->insert([
            'title' => 'اسکریپت - شهر خبر',
            'slug' => 'sX6y',
            'link' => 'http://shahrekhabar.com',
            'author' => 'شهرخبر',
            'content' => '<script language="javascript" src="https://www.shahrekhabar.com/javascript.jsp?type=science&num=10&bullet=true&source=true"></script>',
            'socket' => 'sidebar-001',
            'type' => 'link',
            'state' => '1',
            'just_admin' => '0',
            'expires_at' => '2021-04-04 00:21:21',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('advertises')->insert([
            'title' => 'بنر - یکتانت',
            'slug' => 'iOp8',
            'link' => '',
            'author' => 'یکتانت',
            'content' => '<a rel="nofollow" href="https://ck.yektanet.com/b/click?impression=ZCr%2BKL5vd7V3eGNVCpKJjRXXihIqYrwYu3PEjK6spCY4zOCG1tNYG61l4WqtdPczhxI%2FLOcoXditDOePmFvWLcljKL8%2BZWp6u91pldz9yd3gL68jZuzyshuvUpMxUoEdbiI9jmC0nWvsnK2oD30d%2BRN1rOK6dz94wI%2Bpf4NAIFqKweAh13%2Fv8MwyoRpMbxyM2UfVqeyqEgCvU1uuiGtskxcaBKPevMyZuYgM9xAew69W%2FeAUxXyu3%2FlwqSrC%2BeVxBBcCzzSJ7iWRZNoI80w6Jpc%2BC8Wv6H5JeF%2F2ffnBd885dDJGolvGGd6y1aVN6eabQifG17R3zthqEFnBel8A7xjwvsQHE5YL9wX2Jbz8%2F8ApMxfk1ZXaCBlsKIaKugR9okLjLIJ5SunM%2FEfwIbvcuvHPUJVBoIzl38NbVfI4v5BoW1wxgMKdihs%2BircTwYxNk3QjEGUR0tz8lbV8LAQI1WO44XI7reVk3qQlYYnpQBt7KtwwE%2FHvFifynj6%2BJa9j0SdJoGx6OkeidOSPzR5vag%3D%3D%3AUcL3Lq3f25OQZMqfr6bj%2F4AmmrPev%2B5vpI11abCa8DuSN07Jk45ARxt1schydxsqpZBxGIdniRpZbSfomZPLePOCy7zlJbcKfBzsC8pGFMMa%2Fiyc1RvAxKXTkc67ggtTqGZgerZJsoqSbOgLhauNNnU71VGYmcjD3deetWQ5Pgz4f%2BZz%2FfTRIskJhqraYh%2F02gXOmbgJdG5OdeVYVBtmBNYbGtE32oOIm5fviJyV%2Fp0m1%2FWb4SVtfWBzWHnPf61oTGS5sYR1ZjnoGG%2Bn9oViilSBezwoLH6m9wGler%2BzKSHNJNzpVrgKNCekiGnSi1XeK6LBNADRHiiN2c1lv06p%2BQ%3D%3D&amp;redirect=https%3A%2F%2Faffstat.adro.co%2Fclick%2F5af16e6b-0858-4d8a-94f9-dc68b3d05974" target="_blank" style="position: relative; display: table; margin: 0px auto;">
                    <img class="bnr-img" src="https://mostatil.yektanet.com/media/eee_X0NFwoI.gif" style="height: auto;width: 120px ;margin: 0 auto;display: block;max-width:100%;max-height: 100%;overflow:hidden;" alt=""><div style="position: absolute;top: 0;right: 0;width: 85px;height: 50px;margin: 0;" onclick="event.stopPropagation();event.preventDefault();return false;"><div class="yn-bnr__branding">
                <img class="yn-bnr__logo" src="https://cdn.yektanet.com/assets/images/yn-icon.svg" title="yektanet.com">
                <img class="yn-bnr__text" src="https://cdn.yektanet.com/assets/images/yn.svg" title="yektanet.com"></div></div></a>',
            'socket' => 'sidebar-002',
            'type' => 'banner',
            'state' => '1',
            'just_admin' => '0',
            'expires_at' => '2021-04-04 00:21:21',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('advertises')->insert([
            'title' => 'اسکریپت - خبرپو',
            'slug' => 'klmA',
            'link' => '',
            'author' => 'خبرپو',
            'content' => '<script src="http://www.ghatreh.com/news/cat-all-2-20.js"></script>',
            'socket' => 'article-003',
            'type' => 'link',
            'state' => '1',
            'just_admin' => '0',
            'expires_at' => '2021-04-04 00:21:21',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('advertises')->insert([
            'title' => 'بنر - شهر خبر',
            'slug' => 'sX6y',
            'link' => 'http://shahrekhabar.com',
            'author' => 'شهرخبر',
            'content' => '<div class="container random-box-zxc zxc-inside-content noprint"
     style="box-sizing: border-box; max-width: 100%; margin: 8px; border-top: none; width: 314.016px; font-size: 12px; padding: 12px; float: left; border-right: 4px solid #d90000; font-family: Shabnam, sans-serif; background-color: #ffffff;"
     data-element-name="VIEW_F">
    <div class="type-script position-g7 " style="box-sizing: border-box; overflow: hidden;">
        <div id="sanjagh_position_2" style="box-sizing: border-box;">
            <div class="baZc9JYZy3sYiOgrU-8Mb"
                 style="box-sizing: border-box; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">
                <div class="_3l-fQLMXoGf9xpVeOl-xW7 undefined"
                     style="box-sizing: border-box; direction: rtl; display: flex; flex-wrap: wrap;">
                    <div class="_3Ncalp0pGE7jC58-_85bQM"
                         style="box-sizing: border-box; max-height: 80px; min-height: 40px; overflow: hidden; padding: 10px; -webkit-box-flex: 4; flex: 4 1 0%;">
                        اخذ نمایندگی فروش با سرمایه اندک
                    </div>
                    <div class="_3Ncalp0pGE7jC58-_85bQM"
                         style="box-sizing: border-box; max-height: 80px; min-height: 40px; overflow: hidden; padding: 10px; -webkit-box-flex: 4; flex: 4 1 0%;">
                        نمایندگی چه شرکت&zwnj;هایی را می توان گرفت؟
                    </div>
                    <div class="_3Ncalp0pGE7jC58-_85bQM"
                         style="box-sizing: border-box; max-height: 80px; min-height: 40px; overflow: hidden; padding: 10px; -webkit-box-flex: 4; flex: 4 1 0%;">
                        اخذ نمایندگی فروش با درآمد بالا
                    </div>
                    <div class="_3Ncalp0pGE7jC58-_85bQM"
                         style="box-sizing: border-box; max-height: 80px; min-height: 40px; overflow: hidden; padding: 10px; -webkit-box-flex: 4; flex: 4 1 0%;">
                        آخرین فرصت ثبت نام فوق لیسانس بدون کنکور سراسری
                    </div>
                    <div class="_3Ncalp0pGE7jC58-_85bQM"
                         style="box-sizing: border-box; max-height: 80px; min-height: 40px; overflow: hidden; padding: 10px; -webkit-box-flex: 4; flex: 4 1 0%;">
                        تماشای انیمیشن بلیز و ماشین های هیولا با اینترنت رایگان
                    </div>
                    <div class="_3Ncalp0pGE7jC58-_85bQM"
                         style="box-sizing: border-box; max-height: 80px; min-height: 40px; overflow: hidden; padding: 10px; -webkit-box-flex: 4; flex: 4 1 0%;">
                        درخواست مشاوره برای کارشناسی ارشد بدون کنکور!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>',
            'socket' => 'sidebar-002',
            'type' => 'link',
            'state' => '1',
            'just_admin' => '0',
            'expires_at' => '2021-04-04 00:21:21',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
