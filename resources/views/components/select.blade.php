@props(['options', 'id', 'name', 'value' => ''])

<select id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 rounded-md shadow-sm']) }}>
    @foreach($options as $key => $option)
        <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>
