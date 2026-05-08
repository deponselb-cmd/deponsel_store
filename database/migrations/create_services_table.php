public function up()
{
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('icon')->nullable(); // emoji atau class icon
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
