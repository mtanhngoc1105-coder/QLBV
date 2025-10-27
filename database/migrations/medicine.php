use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Medicine', function (Blueprint $table) {
            $table->id('MedicineID');
            $table->string('MedicineCode', 30)->unique();
            $table->string('MedicineName', 200);
            
            $table->foreignId('CategoryID')->nullable()->constrained('MedicineCategory', 'CategoryID');
            $table->foreignId('SupplierID')->nullable()->constrained('Supplier', 'SupplierID');

            $table->string('BatchNo', 50)->nullable();
            $table->date('ManufactureDate')->nullable();
            $table->date('ExpiryDate')->nullable();
            $table->decimal('UnitPrice', 12, 2)->nullable();
            $table->integer('StockQuantity')->default(0);
            $table->string('DailyDose', 100)->nullable();
            $table->string('SideEffect', 300)->nullable();
            $table->string('Storage', 200)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Medicine');
    }
};