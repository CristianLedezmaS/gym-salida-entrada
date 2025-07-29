@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #232046 0%, #2d225a 100%); min-height: 100vh; padding: 2rem; margin: 0; border: none;">

    <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; padding: 2rem 1.5rem; border: 1px solid #FFD70033; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10); color: #F3F4F6;">
        
        <h2 style="font-size: 2.5rem; font-weight: bold; background: linear-gradient(135deg, #FFD700, #FFA500); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 1rem; text-align: center;">GESTIÓN DE MEMBRESÍAS</h2>
        
        <div style="height: 2px; background: linear-gradient(90deg, #FFD700, #FFA500); margin-bottom: 2rem;"></div>

        <div style="margin-bottom: 1.5rem; text-align: right;">
            <button onclick="openMembresiaModal()" 
               style="background: linear-gradient(135deg, #FFD700, #FFA500); color: white; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; display: inline-flex; align-items: center; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                </svg>
                Registrar Membresía
            </button>
        </div>

        <div style="background: rgba(40,36,70,0.85); backdrop-filter: blur(8px); border-radius: 16px; overflow: hidden; border: 1px solid #FFD70033; box-shadow: 0 4px 24px 0 rgba(0,0,0,0.10);">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; min-width: 100%;">
                <thead style="background: linear-gradient(135deg, #4B0082, #800080); color: white;">
                    <tr>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">ID</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Categoría</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Nombre</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Meses</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Modo</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Precio</th>
                        <th style="padding: 12px 8px; text-align: left; font-size: 14px; font-weight: 600; border-bottom: 2px solid rgba(255,215,0,0.3);">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item2)
                    <tr style="border-bottom: 1px solid rgba(255,215,0,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,215,0,0.1)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item2->id_membresia }}</td>
                        <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item2->categoria }}</td>
                        <td style="padding: 12px 8px; font-size: 14px; font-weight: 500; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item2->nombre }}</td>
                        <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item2->meses }}</td>
                        <td style="padding: 12px 8px; font-size: 14px; color: #F3F4F6; border-right: 1px solid rgba(255,215,0,0.2);">{{ $item2->modo }}</td>
                        <td style="padding: 12px 8px; font-size: 14px; color: #FFD700; font-weight: 600; border-right: 1px solid rgba(255,215,0,0.2);">S/. {{ $item2->precio }}</td>
                        <td style="padding: 12px 8px; font-size: 14px;">
                            <div style="display: flex; align-items: center; gap: 4px;">
                                <button onclick="openEditMembresiaModal({{ $item2->id_membresia }}, '{{ $item2->categoria }}', '{{ $item2->nombre }}', {{ $item2->meses }}, '{{ $item2->modo }}', '{{ $item2->precio }}')" 
                                        style="padding: 8px; background: linear-gradient(135deg, #F97316, #EA580C); color: white; border-radius: 8px; border: none; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Editar">
                                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('membresia.destroy', $item2->id_membresia) }}" method="post" style="display:inline;">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirmarEliminacion(event, '{{ $item2->nombre }}', '{{ $item2->categoria }}')" 
                                            style="padding: 8px; background: linear-gradient(135deg, #EF4444, #DC2626); color: white; border-radius: 8px; border: none; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Eliminar">
                                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
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
