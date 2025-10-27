use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('DoctorSchedule', function (Blueprint $table) {
            $table->id('ScheduleID');
            $table->foreignId('DoctorID')->constrained('Doctor', 'DoctorID')->onDelete('cascade'); 
            $table->date('WorkDate');
            $table->time('StartTime');
            $table->time('EndTime');
            $table->unique(['DoctorID', 'WorkDate', 'StartTime', 'EndTime'], 'UX_DoctorSchedule_Time');
        });

        Schema::create('Appointment', function (Blueprint $table) {
            $table->id('AppointmentID');
            $table->string('AppointmentCode', 30)->unique();
            
            $table->foreignId('PatientID')->constrained('Patient', 'PatientID');
            $table->foreignId('DoctorID')->constrained('Doctor', 'DoctorID')->onDelete('cascade'); 
            
            $table->dateTime('StartDateTime'); 
            $table->dateTime('EndDateTime');
            
            $table->string('Status', 30)->default('Scheduled');
            $table->string('Notes', 500)->nullable();
            
            $table->unique(['DoctorID', 'StartDateTime'], 'UX_Appointment_Doctor_Start');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Appointment');
        Schema::dropIfExists('DoctorSchedule');
    }
};