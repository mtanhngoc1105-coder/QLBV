use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Department', function (Blueprint $table) {
            $table->id('DepartmentID');
            $table->string('DepartmentName', 150)->unique();
            $table->string('Description', 300)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Department');
    }
};