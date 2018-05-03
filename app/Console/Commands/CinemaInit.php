<?php

namespace App\Console\Commands;

use App\model\Screen;
use App\model\Seat;
use App\model\User;
use Illuminate\Console\Command;



class CinemaInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cinema:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化数据表、admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate');
//        $this->call('db:seed');
        $this->tableContent();
    }

    public function tableContent()
    {
        $password = bcrypt($this->secret('请输入管理员admin的密码'));
        $phone = $this->ask('请输入管理员admin的联系电话');
        User::create([
            'username' => 'admin',
            'password' => $password,
            'phone' => $phone,
            'money' => 999999,
        ]);

        $sIdLen = $this->ask('请输入创建的影厅个数：默认2',2);
        $rowLen = $this->ask('请输入每一个影厅座位的行数：默认7',7);
//        $columnLen = $this->ask('请输入每一个影厅座位的列数：默认12',12);
        $this->info('影厅列数为12列');
        $columnLen = 12;
        for ($sId=1;$sId<=$sIdLen;$sId++)
        {
            Screen::create([
                'sId' => $sId
            ]);
            for ($row=1;$row<=$rowLen;$row++)
            {
                for ($column=1;$column<=$columnLen;$column++)
                {
                    Seat::create([
                        'sId' => $sId,
                        'row' => $row,
                        'column' => $column,
                        'status' => 0,
                    ]);
                }
            }
        }
    }


}
