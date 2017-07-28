<?php

namespace Laravel\Horizon;

class WorkerCommandString
{
    /**
     * The base worker command.
     *
     * @var string
     */
    public static $command = 'exec php artisan horizon:work';

    /**
     * Get the command-line representation of the options for a worker.
     *
     * @param  \Laravel\Horizon\SupervisorOptions  $options
     * @return string
     */
    public static function fromOptions(SupervisorOptions $options)
    {
        return sprintf(
            "%s {$options->connection} %s",
            static::$command,
            static::toOptionsString($options)
        );
    }

    /**
     * Get the additional option string for the command.
     *
     * @param  \Laravel\Horizon\SupervisorOptions  $options
     * @return string
     */
    public static function toOptionsString(SupervisorOptions $options)
    {
        return sprintf('%s --supervisor=%s',
            QueueCommandString::toOptionsString($options), $options->name
        );
    }

    /**
     * Reset the base command back to its default value.
     *
     * @return void
     */
    public static function reset()
    {
        static::$command = 'exec php artisan horizon:work';
    }
}
