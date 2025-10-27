use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Patient', function (Blueprint $table) {
            $table->id('PatientID');
            $table->string('PatientCode', 30)->unique();
            $table->string('FullName', 150);
            $table->date('DOB')->nullable();
            $table->char('Gender', 1)->nullable(); 
            $table->string('Phone', 20)->nullable()->index();
            $table->string('Address', 300)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Patient');
    }
};