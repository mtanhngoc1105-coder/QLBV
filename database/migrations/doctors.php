use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Doctor', function (Blueprint $table) {
            $table->id('DoctorID');
            $table->string('DoctorCode', 30)->unique();
            $table->string('DoctorName', 150);
            // ON DELETE SET NULL
            $table->foreignId('DepartmentID')->nullable()->constrained('Department', 'DepartmentID')->onDelete('set null');
            $table->string('Phone', 20)->nullable();
            $table->string('Email', 150)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Doctor');
    }
};