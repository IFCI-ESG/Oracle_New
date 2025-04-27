use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddLoginAttemptsAndBlockStatusToUsersTable extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE users ADD (login_attempts NUMBER(1) DEFAULT 0)');
        DB::statement('ALTER TABLE users ADD (isblocked NUMBER(1) DEFAULT 0)');
    }

    public function down()
    {
        DB::statement('ALTER TABLE users DROP COLUMN login_attempts');
        DB::statement('ALTER TABLE users DROP COLUMN isblocked');
    }
} 