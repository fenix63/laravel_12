{{-- resources/views/modal/alpine.blade.php --}}

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Модальное окно с Alpine.js</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
</head>
<body>
<div class="container mt-5" x-data="modalComponent()">
	<button @click="openModal" class="btn btn-primary">
		Открыть модальное окно
	</button>

	<!-- Модальное окно -->
	<div x-show="isOpen"
		 x-transition.duration.300ms
		 class="modal-backdrop fade show"
		 style="display: none; background: rgba(0,0,0,0.5);"
		 @click.self="closeModal">

		<div class="modal d-block" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" x-text="title"></h5>
						<button type="button" class="btn-close" @click="closeModal"></button>
					</div>
					<div class="modal-body">
						<div x-show="loading">
							<div class="spinner-border text-primary" role="status">
								<span class="visually-hidden">Загрузка...</span>
							</div>
						</div>
						<div x-show="!loading" x-html="content"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" @click="closeModal">Закрыть</button>
						<button type="button" class="btn btn-primary" @click="saveData">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    function modalComponent() {
        return {
            isOpen: false,
            loading: false,
            title: 'Заголовок',
            content: '',

            async openModal() {
                this.isOpen = true;
                this.loading = true;
                this.title = 'Загрузка...';

                try {
                    const response = await fetch('{{ route("modal.data") }}');
                    const data = await response.json();

                    this.title = data.title;
                    this.content = `<p>${data.content}</p><p><small>${data.timestamp}</small></p>`;
                } catch (error) {
                    this.content = '<div class="alert alert-danger">Ошибка загрузки</div>';
                } finally {
                    this.loading = false;
                }
            },

            closeModal() {
                this.isOpen = false;
                this.content = '';
            },

            saveData() {
                alert('Данные сохранены!');
                this.closeModal();
            }
        }
    }
</script>
</body>
</html>