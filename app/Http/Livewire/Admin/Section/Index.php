<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use App\Http\Livewire\WithSorting;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithSorting;
    use WithFileUploads;

    public $image;

    public $section;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'editModal', 'delete',
    ];

    public $refreshIndex;

    public $showModal = false;

    public $editModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $language_id;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public array $rules = [
        'section.language_id' => ['required'],
        'section.page' => ['required'],
        'section.title' => ['required', 'string', 'max:255'],
        'section.featured_title' => ['nullable', 'string', 'max:255'],
        'section.subtitle' => ['nullable', 'string', 'max:255'],
        'section.label' => ['nullable', 'string', 'max:255'],
        'section.description' => ['nullable'],
        'section.bg_color' => ['nullable'],
        'section.text_color' => ['nullable'],
        'section.is_category' => ['nullable'],
        'section.is_product' => ['nullable'],
        'section.is_form' => ['nullable'],
        'section.position' => ['nullable'],
        'section.link' => ['nullable'],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Section())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Section::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $sections = $query->paginate($this->perPage);

        return view('livewire.admin.section.index', compact('sections'));
    }

      // Section  Delete
      public function delete(Section $section)
      {
          abort_if(Gate::denies('section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

          $section->delete();

          $this->alert('warning', __('Section Deleted successfully!'));
      }

     // Section  Clone
     public function clone(Section $section)
     {
         $section_details = Section::find($section->id);

         Section::create([
             'language_id' => $section_details->language_id,
             'page' => $section_details->page,
             'title' => $section_details->title,
             'subtitle' => $section_details->subtitle,
             'link' => $section_details->link,
             'image' => $section_details->image,
             'description' => $section_details->description,
             'status' => 0,
         ]);
         $this->alert('success', __('Section Cloned successfully!'));
     }

     public function editModal($section)
     {
         $this->resetErrorBag();

         $this->resetValidation();

         $this->section = Section::find($section);

         $this->editModal = true;
     }

     public function update()
     {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->section->title).'-'.Str::random(2).'.'.$this->image->extension();
            $this->image->storeAs('sections', $imageName);
            $this->section->image = $imageName;
        }

        $this->section->save();

        $this->alert('success', __('Section updated successfully!'));

        $this->editModal = false;

     }
}
