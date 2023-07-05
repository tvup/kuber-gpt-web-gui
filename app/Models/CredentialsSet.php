<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property User $user
 * @property Credential[] $credentials
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property RunSet[] $runSets
 */
class CredentialsSet extends BaseModel
{
    public const OPENAI_API_KEY = "openai_api_key";
    public const ELEVENLABS_API_KEY = "elevenlabs_api_key";
    public const ELEVENLABS_VOICE_ID = "elevenlabs_voice_id";
    public const SMART_LLM_MODEL = "smart_llm_model";
    public const FAST_LLM_MODEL = "fast_llm_model";
    public const GOOGLE_API_KEY = "google_api_key";
    public const GOOLE_CUSTOM_SEARCH_ENGINE_ID = "google_custom_search_engine_id";
    public const USE_AZURE = "use_azure";
    public const IMAGE_PROVIDER = "image_provider";
    public const MEMORY_BACKEND = "memory_backend";
    public const REDIS_HOST = "redis_host";
    public const REDIS_PORT = "redis_port";
    public const REDIS_PASSWORD = "redis_password";
    public const WIPE_REDIS_ON_START = "wipe_redis_on_start";
    public const EXECUTE_LOCAL_COMMANDS = "execute_local_commands";
    public const RESTRICT_TO_WORKSPACE = "restrict_to_workspace";
    public const BROWSE_CHUNK_MAX_LENGTH = "browse_chunk_max_length";
    public const USER_AGENT = "user_agent";
    public const AI_SETTINGS_FILE = "ai_settings_file";
    public const USE_WEB_BROWSER = "use_web_browser";
    public const TEMPERATURE = "temperature";
    public const MEMORY_INDEX = "memory_index";
    public const HUGGINGFACE_API_TOKEN = "huggingface_api_token";
    public const HUGGINGFACE_AUDIO_TO_TEXT_MODEL = "huggingface_audio_to_text_model";
    public const GITHUB_API_KEY = "github_api_key";
    public const GITHUB_USERNAME = "github_username";

    /**
     * @var array|string[]
     */
    public static array $keys = [
        self::OPENAI_API_KEY,
        self::ELEVENLABS_API_KEY,
        self::ELEVENLABS_VOICE_ID,
        self::SMART_LLM_MODEL,
        self::FAST_LLM_MODEL,
        self::GOOGLE_API_KEY,
        self::GOOLE_CUSTOM_SEARCH_ENGINE_ID,
        self::USE_AZURE,
        self::IMAGE_PROVIDER,
        self::MEMORY_BACKEND,
        self::REDIS_HOST,
        self::REDIS_PORT,
        self::REDIS_PASSWORD,
        self::WIPE_REDIS_ON_START,
        self::EXECUTE_LOCAL_COMMANDS,
        self::RESTRICT_TO_WORKSPACE,
        self::BROWSE_CHUNK_MAX_LENGTH,
        self::USER_AGENT,
        self::AI_SETTINGS_FILE,
        self::USE_WEB_BROWSER,
        self::TEMPERATURE,
        self::MEMORY_INDEX,
        self::HUGGINGFACE_API_TOKEN,
        self::HUGGINGFACE_AUDIO_TO_TEXT_MODEL,
        self::GITHUB_API_KEY,
        self::GITHUB_USERNAME,
    ];

    /**
     * @var array|string[]
     */
    public static array $defaultValues = [
        self::OPENAI_API_KEY=>'your-openai-api-key',
        self::ELEVENLABS_API_KEY=>null,
        self::ELEVENLABS_VOICE_ID=>null,
        self::SMART_LLM_MODEL=>'gpt-3.5-turbo',
        self::FAST_LLM_MODEL=>'gpt-3.5-turbo',
        self::GOOGLE_API_KEY=>null,
        self::GOOLE_CUSTOM_SEARCH_ENGINE_ID=>null,
        self::USE_AZURE=>'False',
        self::IMAGE_PROVIDER=>'dalle',
        self::MEMORY_BACKEND=>'json_file',
        self::REDIS_HOST=>'localhost',
        self::REDIS_PORT=>'6379',
        self::REDIS_PASSWORD=>'',
        self::WIPE_REDIS_ON_START=>'True',
        self::EXECUTE_LOCAL_COMMANDS=>'False',
        self::RESTRICT_TO_WORKSPACE=>'True',
        self::BROWSE_CHUNK_MAX_LENGTH=>'3000',
        self::USER_AGENT=>'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36',
        self::AI_SETTINGS_FILE=>'ai_settings.yaml',
        self::USE_WEB_BROWSER=>'chrome',
        self::TEMPERATURE=>0,
        self::MEMORY_INDEX=>'auto-gpt',
        self::HUGGINGFACE_API_TOKEN=>null,
        self::HUGGINGFACE_AUDIO_TO_TEXT_MODEL=>'CompVis/stable-diffusion-v1-4',
        self::GITHUB_API_KEY=>null,
        self::GITHUB_USERNAME=>null,
    ];

    use HasFactory;

    /**
     * @return BelongsTo<User, CredentialsSet>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Credential::class>
     */
    public function credentials(): HasMany
    {
        return $this->hasMany(Credential::class);
    }

    /**
     * @return HasMany<RunSet, CredentialsSet>
     */
    public function runSets(): HasMany
    {
        return $this->hasMany(RunSet::class);
    }

}
