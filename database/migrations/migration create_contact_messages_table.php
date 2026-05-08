public function up()
{
    Schema::create('contact_messages', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->string('service_type');
        $table->text('message');
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}
