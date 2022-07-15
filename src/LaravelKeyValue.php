<?php

namespace Samaphp\LaravelKeyValue;

use Illuminate\Database\Eloquent\Builder;

class LaravelKeyValue
{
    /**
     * The name of the collection object.
     *
     * @var string
     */
    protected $collection = '';

    /**
     * Constructs a key/value object.
     *
     * @param string $collection
     *   The name of the collection object being constructed.
     */
    public function __construct(string $collection) {
        $this->collection = $collection;
    }

    /**
     * Get a specific key value.
     */
    public function get($key, $default = null)
    {
        $result = $this->modelQuery()
            ->where('collection', '=', $this->collection)
            ->where('key', '=', $key)
            ->first()->getAttribute('value');
        if (!empty($result)) {
            $decoded_result = json_decode($result);
            if (json_last_error() === JSON_ERROR_NONE) {
                $result = $decoded_result;
            }
            return $result;
        }
        return $default;
    }

    /**
     * Get all collection values.
     */
    public function all()
    {
        // @todo If one of the values are encoded in JSON we need to decode it here.
        return $this->modelQuery()
            ->where('collection', '=', $this->collection)
            ->pluck('value', 'key')->toArray();
    }

    /**
     * Set or update the key value.
     */
    public function set($key, $value = null)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $this->modelQuery()->updateOrCreate(
            ['collection' => $this->collection, 'key' => $key],
            ['collection' => $this->collection, 'key' => $key, 'value' => $value],
        );
        return true;
    }

    /**
     * Delete a specific key.
     */
    public function delete($key)
    {
        return $this->modelQuery()
            ->where('collection', $this->collection)
            ->where('key', $key)
            ->delete();
    }

    /**
     * Get the model query builder.
     *
     * @return Builder
     */
    protected function modelQuery()
    {
        return app('\Samaphp\LaravelKeyValue\Models\KeyValue');
    }

}
