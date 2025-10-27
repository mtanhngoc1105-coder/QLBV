use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Prescription', function (Blueprint $table) {
            $table->id('PrescriptionID');
            $table->string('PrescriptionCode', 30)->unique();
            $table->foreignId('PatientID')->constrained('Patient', 'PatientID');
            
            $table->foreignId('DoctorID')->nullable()->constrained('Doctor', 'DoctorID')->onDelete('set null'); 
            
            $table->dateTime('DateIssued')->useCurrent(); 
            $table->string('Notes', 500)->nullable();
        });

        Schema::create('PrescriptionDetail', function (Blueprint $table) {
            $table->id('DetailID');
            $table->foreignId('PrescriptionID')->constrained('Prescription', 'PrescriptionID')->onDelete('cascade'); 
            $table->foreignId('MedicineID')->constrained('Medicine', 'MedicineID');
            $table->integer('Quantity');
            $table->decimal('UnitPrice', 12, 2)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('PrescriptionDetail');
        Schema::dropIfExists('Prescription');
    }
};