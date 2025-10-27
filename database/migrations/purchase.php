use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Purchase', function (Blueprint $table) {
            $table->id('PurchaseID');
            $table->string('PurchaseCode', 30)->unique();
            $table->foreignId('SupplierID')->constrained('Supplier', 'SupplierID');
            $table->dateTime('PurchaseDate')->useCurrent(); 
            $table->string('Notes', 500)->nullable();
        });

        Schema::create('PurchaseDetail', function (Blueprint $table) {
            $table->id('PurchaseDetailID');
            $table->foreignId('PurchaseID')->constrained('Purchase', 'PurchaseID')->onDelete('cascade'); 
            $table->foreignId('MedicineID')->constrained('Medicine', 'MedicineID');
            $table->integer('Quantity');
            $table->decimal('UnitPrice', 12, 2)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('PurchaseDetail');
        Schema::dropIfExists('Purchase');
    }
};