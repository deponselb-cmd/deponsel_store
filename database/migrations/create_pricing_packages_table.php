public function up()
{
    Schema::create('pricing_packages', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 15, 2);
        $table->text('features')->nullable(); // simpan sebagai JSON atau string dipisah koma, kita pakai JSON
        $table->string('badge')->nullable(); // misal "Paling Laris"
        $table->integer('ordering')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
