@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #232046 0%, #2d225a 100%); min-height: 100vh; padding: 2rem; margin: 0; border: none;">
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <h2 style="font-size: 2.2rem; font-weight: bold; color: #F3F4F6; margin-bottom: 1rem; letter-spacing: 1px;">GESTIÓN DE MEMBRESÍAS</h2>
        <div style="width: 90px; height: 4px; background: linear-gradient(90deg, #FFD700 0%, #F3F4F6 100%); margin: 0 auto; border-radius: 2px;"></div>
    </div>

    <div style="max-width: 1100px; margin: 0 auto; padding: 0 1rem;">
        <div style="margin-bottom: 1.5rem; text-align: right;">
            <button onclick="openMembresiaModal()" style="display: inline-block; padding: 10px 22px; background: linear-gradient(90deg, #FFD700 0%, #F3F4F6 100%); color: #232046; font-weight: 600; border-radius: 10px; box-shadow: 0 2px 8px 0 rgba(0,0,0,0.10); text-decoration: none; transition: all 0.2s; letter-spacing: 1px; border: none; cursor: pointer;"
               onmouseover="this.style.background='linear-gradient(90deg, #F3F4F6 0%, #FFD700 100%)'; this.style.color='#2d225a';"
               onmouseout="this.style.background='linear-gradient(90deg, #FFD700 0%, #F3F4F6 100%)'; this.style.color='#232046';">
                <i class="fas fa-plus" style="margin-right: 8px;"></i>Registrar Membresía
            </button>
        </div>
        <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 2rem 1.5rem; border: 1px solid #FFD70033; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10); color: #F3F4F6;">
            @if (session('CORRECTO'))
                <div style="margin-bottom: 1rem; color: #10B981; font-weight: 600;">{{ session('CORRECTO') }}</div>
            @endif
            @if (session('INCORRECTO'))
                <div style="margin-bottom: 1rem; color: #EF4444; font-weight: 600;">{{ session('INCORRECTO') }}</div>
            @endif
            @if (session('AVISO'))
                <div style="margin-bottom: 1rem; color: #F59E0B; font-weight: 600;">{{ session('AVISO') }}</div>
            @endif

            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; background: transparent; color: #F3F4F6;">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #232046 60%, #FFD700 100%); color: #FFD700;">
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">ID</th>
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">Categoría</th>
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">Nombre</th>
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">Meses</th>
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">Modo</th>
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">Precio</th>
                            <th style="padding: 12px 8px; text-align: left; font-weight: 600; border-bottom: 2px solid #FFD70033;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $item2)
                        <tr style="border-bottom: 1px solid #FFD70022; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,215,0,0.07)';" onmouseout="this.style.background='transparent';">
                            <td style="padding: 10px 8px;">{{ $item2->id_membresia }}</td>
                            <td style="padding: 10px 8px;">{{ $item2->categoria }}</td>
                            <td style="padding: 10px 8px; font-weight: 500;">{{ $item2->nombre }}</td>
                            <td style="padding: 10px 8px;">{{ $item2->meses }}</td>
                            <td style="padding: 10px 8px;">{{ $item2->modo }}</td>
                            <td style="padding: 10px 8px; color: #FFD700; font-weight: 600;">S/. {{ $item2->precio }}</td>
                            <td style="padding: 10px 8px;">
                                <div style="display: flex; gap: 8px;">
                                    <button onclick="openEditMembresiaModal({{ $item2->id_membresia }}, '{{ $item2->categoria }}', '{{ $item2->nombre }}', {{ $item2->meses }}, '{{ $item2->modo }}', '{{ $item2->precio }}')" title="Editar" style="padding: 6px 10px; background: linear-gradient(90deg, #6366F1 0%, #818CF8 100%); color: white; border-radius: 6px; font-size: 15px; display: flex; align-items: center; border: none; transition: background 0.2s; cursor: pointer;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('membresia.destroy', $item2->id_membresia) }}" method="post" style="display:inline;">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirmarEliminacion(event, '{{ $item2->nombre }}', '{{ $item2->categoria }}')" title="Eliminar" style="padding: 6px 10px; background: linear-gradient(90deg, #EF4444 0%, #DC2626 100%); color: white; border-radius: 6px; font-size: 15px; border: none; display: flex; align-items: center; transition: background 0.2s;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 1.5rem;">
                {{ $datos->links() }}
            </div>
        </div>
    </div>

    <!-- Modal de Registro de Membresía -->
    <div id="modalMembresia" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); align-items:center; justify-content:center;">
        <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:480px; width:95%; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative;">
            <button onclick="closeMembresiaModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
            <h3 style="font-size:1.3rem; font-weight:600; color:#FFD700; margin-bottom:1.2rem; text-align:center;">Registrar Nueva Membresía</h3>
            <form action="{{ route('membresia.store') }}" method="POST" autocomplete="off">
                @csrf
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Categoría</label>
                        <select name="categoria" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                            <option value="">Selecciona una Actividad</option>
                            <option value="maquinas">Maquinas</option>
                            <option value="cardio">Gimnasia Artística/Rítmica</option>
                            <option value="pesas">Levantamiento de potencia</option>
                            <option value="clases">Para niños de 4-12 años</option>
                            <option value="clases">Acrobacias de competencia</option>
                        </select>
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Nombre</label>
                        <input type="text" name="nombre" required placeholder="Ejemplo: 1 mes" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Meses</label>
                        <input type="number" name="mes" required min="1" placeholder="Número de meses" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Modo</label>
                        <select name="modo" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                            <option value="">Seleccionar Modo</option>
                            <option value="diario">Diario</option>
                        </select>
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Precio</label>
                        <input type="text" name="precio" required placeholder="Precio *" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                    </div>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:1.5rem;">
                    <button type="button" onclick="closeMembresiaModal()" style="padding:8px 18px; background:rgba(255,255,255,0.10); color:#F3F4F6; border:none; border-radius:8px; font-weight:500; cursor:pointer;">Cancelar</button>
                    <button type="submit" style="padding:8px 18px; background:linear-gradient(90deg,#FFD700 0%,#F3F4F6 100%); color:#232046; border:none; border-radius:8px; font-weight:600; cursor:pointer;">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Edición de Membresía -->
    <div id="modalEditMembresia" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(30,23,54,0.85); align-items:center; justify-content:center;">
        <div style="background:rgba(40,36,70,0.97); border-radius:18px; max-width:480px; width:95%; padding:2rem 1.5rem; box-shadow:0 8px 32px 0 rgba(0,0,0,0.25); border:2px solid #FFD70033; position:relative;">
            <button onclick="closeEditMembresiaModal()" style="position:absolute; top:18px; right:18px; background:rgba(255,255,255,0.12); border:none; border-radius:50%; width:32px; height:32px; color:#FFD700; font-size:20px; cursor:pointer;">&times;</button>
            <h3 style="font-size:1.3rem; font-weight:600; color:#FFD700; margin-bottom:1.2rem; text-align:center;">Editar Membresía</h3>
            <form action="{{ route('membresia.update', '') }}" method="POST" id="editForm" autocomplete="off">
                @csrf
                @method('PUT')
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Categoría</label>
                        <select name="categoria" id="editCategoria" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                            <option value="">Selecciona una Actividad</option>
                            <option value="maquinas">Maquinas</option>
                            <option value="cardio">Gimnasia Artística/Rítmica</option>
                            <option value="pesas">Levantamiento de potencia</option>
                            <option value="clases">Para niños de 4-12 años</option>
                            <option value="clases">Acrobacias de competencia</option>
                        </select>
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Nombre</label>
                        <input type="text" name="nombre" id="editNombre" required placeholder="Ejemplo: 1 mes" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Meses</label>
                        <input type="number" name="mes" id="editMeses" required min="1" placeholder="Número de meses" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Modo</label>
                        <select name="modo" id="editModo" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                            <option value="">Seleccionar Modo</option>
                            <option value="diario">Diario</option>
                        </select>
                    </div>
                    <div>
                        <label style="color:#F3F4F6; font-size:0.97rem; font-weight:500;">Precio</label>
                        <input type="text" name="precio" id="editPrecio" required placeholder="Precio *" style="width:100%; padding:10px; border-radius:8px; border:1px solid #FFD70033; background:rgba(30,23,54,0.7); color:#F3F4F6; margin-top:4px;">
                    </div>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:1.5rem;">
                    <button type="button" onclick="closeEditMembresiaModal()" style="padding:8px 18px; background:rgba(255,255,255,0.10); color:#F3F4F6; border:none; border-radius:8px; font-weight:500; cursor:pointer;">Cancelar</button>
                    <button type="submit" style="padding:8px 18px; background:linear-gradient(90deg,#FFD700 0%,#F3F4F6 100%); color:#232046; border:none; border-radius:8px; font-weight:600; cursor:pointer;">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openMembresiaModal() {
            document.getElementById('modalMembresia').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeMembresiaModal() {
            document.getElementById('modalMembresia').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        function openEditMembresiaModal(id, categoria, nombre, meses, modo, precio) {
            document.getElementById('editForm').action = '{{ url('membresia') }}/' + id;
            document.getElementById('editCategoria').value = categoria;
            document.getElementById('editNombre').value = nombre;
            document.getElementById('editMeses').value = meses;
            document.getElementById('editModo').value = modo;
            document.getElementById('editPrecio').value = precio;
            document.getElementById('modalEditMembresia').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeEditMembresiaModal() {
            document.getElementById('modalEditMembresia').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        // Cerrar modal con Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMembresiaModal();
                closeEditMembresiaModal();
            }
        });
        // Cerrar modal al hacer clic fuera del contenido
        document.getElementById('modalMembresia').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMembresiaModal();
            }
        });
        document.getElementById('modalEditMembresia').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditMembresiaModal();
            }
        });

        function confirmarEliminacion(event, nombre, categoria) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: `Esta acción eliminará la membresía "${nombre}" de la categoría "${categoria}". Esta acción no se puede deshacer.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6366F1',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'swal-popup',
                    title: 'swal-title',
                    content: 'swal-content',
                    actions: 'swal-actions',
                    confirmButton: 'swal-confirm-button',
                    cancelButton: 'swal-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
            
            return false; // Prevenir el envío del formulario por defecto
        }
    </script>
</div>
@endsection
