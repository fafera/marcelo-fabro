<div>
    <select id="project"name="project" wire:model="quote.project_id" class="form-control">
        <option value=''>Selecione o projeto</option>
        @foreach($projects as $project)
            <option value={{ $project->id }}>{{ $project->title }}</option>
        @endforeach
    </select>
</div>