use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Supplier', function (Blueprint $table) {
            $table->id('SupplierID');
            $table->string('SupplierName', 150)->unique();
            $table->string('Contact', 150)->nullable();
            $table->string('Phone', 20)->nullable();
            $table->string('Email', 150)->nullable();
        });

        Schema::create('MedicineCategory', function (Blueprint $table) {
            $table->id('CategoryID');
            $table->string('CategoryName', 150)->unique();
            $table->string('Description', 300)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('MedicineCategory');
        Schema::dropIfExists('Supplier');
    }
};