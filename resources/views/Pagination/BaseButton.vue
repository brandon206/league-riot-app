<template>
  <button :disabled="disabled" class="button button-round button--red">
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    disabled: {
      type: Boolean,
      default: false
    }
  }
};
</script>

<style scoped lang="scss">
$c-white: #fff;
$c-primary-accent: #ff9a57;
$c-primary-accent--dark: #dd8346;

@mixin sizing($args, $prefix: "") {
  $width: if(length($args) == 2, nth($args, 1), $args);
  $height: if(length($args) == 2, nth($args, 2), $args);

  #{$prefix}width: $width;
  #{$prefix}height: $height;
}

@mixin circle($args) {
  @include sizing($args);

  border-radius: 50%;
}

@mixin center($position) {
  display: flex;

  @if $position == "both" {
    align-items: center;
    justify-content: center;
  } @else if $position == "vertical" {
    align-items: center;
  } @else if $position == "horizontal" {
    justify-content: center;
  } @else if $position == "none" {
    align-items: stretch;
    justify-content: flex-start;
  }
}

.button {
  outline: none;
  transition: all 300ms ease-in-out;

  &[disabled] {
    opacity: 0.3;
  }

  &--red {
    background-color: $c-primary-accent;

    .button-ellipse-icon {
      color: $c-white;
      background-color: $c-primary-accent--dark;
    }
  }

  &-round {
    @include circle(40px);
    @include center(both);

    text-decoration: none;
    border: none;

    svg {
      color: $c-white;
    }
  }
}
</style>
